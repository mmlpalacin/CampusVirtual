<?php

namespace App\Livewire;

use App\Models\Configuracion;
use App\Models\Curso;
use App\Models\Horario;
use App\Models\Inscripcion;
use App\Models\Materia;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserAsignacion extends Component
{
    public $roles, $cursos, $materias, $user;
    public $selectedRole, $selectedCurso, $asignaciones =[];

    public function mount($user)
    {
        $this->user = $user;
        $this->roles = Role::all();
        $this->cursos = Curso::all();

        if($user->hasRole('profesor')){
            $this->materias = Materia::all();
            $this->asignaciones = $this->loadAsignacion();
        }elseif ($user->hasRole('alumno')) {
            $this->selectedCurso = $user->inscripcion ? $user->inscripcion->curso_id : null;
        } else {
            $this->selectedCurso = [];
        }
        $this->selectedRole = $user->roles->first()->id ?? null;
    }
    
    public function loadAsignacion()
    {
        return Horario::where('profesor_id', $this->user->id)
        ->get(['id', 'curso_id', 'materia_id', 'dia', 'hora_inicio', 'hora_fin'])
        ->toArray();
    } 

    public function addHorario()
    {
        $this->asignaciones[] = [
            'curso_id' => '',
            'materia_id' => '',
            'dia' => '',
            'hora_inicio' => '',
            'hora_fin' => ''
        ];
    }

    public function removeHorario($index)
    {
        unset($this->asignaciones[$index]);
        $this->asignaciones = array_values($this->asignaciones);
    }

    public function save()
    {
        $validationRules = [];

        $validationRules['selectedRole'] = 'required|exists:roles,id';

        if ($this->user->hasRole('alumno') && $this->selectedCurso) {
            $validationRules['selectedCurso'] = 'required|exists:cursos,id';
        }

        if ($this->user->hasRole('profesor') && $this->asignaciones) {
            $validationRules['asignaciones.*.curso_id'] = 'required|exists:cursos,id';
            $validationRules['asignaciones.*.materia_id'] = 'required|exists:materias,id';
            $validationRules['asignaciones.*.dia'] = 'nullable|string';
            $validationRules['asignaciones.*.hora_inicio'] = 'nullable|date_format:H:i';
            $validationRules['asignaciones.*.hora_fin'] = 'nullable|date_format:H:i|after:asignaciones.*.hora_inicio';
        }

        $this->validate($validationRules);

        $this->user->roles()->sync([$this->selectedRole]);

        if ($this->user->roles('alumno')) {
            $Inscripcion = Inscripcion::where('user_id', $this->user->id)->latest()->first();
            if(isset($Inscripcion)){
                $Inscripcion->update([
                    'curso_id' => $this->selectedCurso,
                ]);
            }else{
                Inscripcion::create([
                    'user_id' => $this->user->id,
                    'curso_id' => $this->selectedCurso
                ]);
            }
        }

        foreach ($this->asignaciones as $asignacion) {
            if(isset($asignacion['id'])){
                if ($asignacion['curso_id'] && $asignacion['materia_id'] && $asignacion['dia']) {
                    Horario::where('id', $asignacion['id'])->update([
                        'profesor_id' => $this->user->id,
                        'curso_id' => $asignacion['curso_id'],
                        'materia_id' => $asignacion['materia_id'],
                        'dia' => $asignacion['dia'],
                        'hora_inicio' => $asignacion['hora_inicio'],
                        'hora_fin' => $asignacion['hora_fin']
                    ]);
                }
            }else {
                Horario::create([
                    'profesor_id' => $this->user->id,
                    'curso_id' => $asignacion['curso_id'],
                    'materia_id' => $asignacion['materia_id'],
                    'dia' => !empty($asignacion['dia']) ? $asignacion['dia'] : null,
                    'hora_inicio' => !empty($asignacion['hora_inicio']) ? $asignacion['hora_inicio'] : null,
                    'hora_fin' => !empty($asignacion['hora_fin']) ? $asignacion['hora_fin'] : null,
                ]);
            }
        }

        return redirect()->route('admin.users.index')->with('Usuario actualizado con exito');
    }

    public function render()
    {
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $dias = $configuracion->dias;
        return view('livewire.user-asignacion', [
            'dias' => $dias,
        ]);
    }
}
