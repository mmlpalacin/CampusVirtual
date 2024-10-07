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
    public $selectedRole, $selectedCurso, $asignaciones = [], $preceptor = [];
    
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
        }elseif($user->hasRole('preceptor')) {
            foreach ($this->cursos as $curso) {
                $this->preceptor[$curso->id] = [
                    'curso_id' => $curso->id,
                    'preceptor_tipo' => [
                        'aula' => $curso->preceptor1()->exists() && $curso->preceptor1->id == $user->id,
                        'taller' => $curso->preceptor2()->exists() && $curso->preceptor2->id == $user->id,
                    ],
                ];
            }
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

        if ($this->user->hasRole('preceptor')) {
            $validationRules['preceptor'] = 'required|array';    
            foreach ($this->preceptor as $cursoId => $cursoData) {
                $validationRules['preceptor.' . $cursoId . '.curso_id'] = 'required|exists:cursos,id';
                $validationRules['preceptor.' . $cursoId . '.preceptor_tipo'] = 'required|array';
                $validationRules['preceptor.' . $cursoId . '.preceptor_tipo.aula'] = 'nullable|boolean';
                $validationRules['preceptor.' . $cursoId . '.preceptor_tipo.taller'] = 'nullable|boolean';
            }
        }        

        $this->validate($validationRules);

        $this->user->roles()->sync([$this->selectedRole]);

        if ($this->user->hasrole('alumno')) {
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

        if ($this->user->hasrole('profesor')) {
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
        }

        if ($this->user->hasRole('preceptor')) {
            foreach ($this->preceptor as $curso) {
                if (!empty($curso['curso_id'])) {
                    $cursoModel = Curso::find($curso['curso_id']);
                    if ($cursoModel) {
                        $currentPreceptorAula = $cursoModel->preceptor1()->first();
                        $currentPreceptorTaller = $cursoModel->preceptor2()->first();
    
                        if ($curso['preceptor_tipo']['aula']) {
                            $cursoModel->preceptor1()->associate($this->user);
                        } elseif ($currentPreceptorAula) {
                            $cursoModel->preceptor1()->dissociate();
                        }
    
                        if ($curso['preceptor_tipo']['taller']) {
                            $cursoModel->preceptor2()->associate($this->user);
                        } elseif ($currentPreceptorTaller) {
                            $cursoModel->preceptor2()->dissociate();
                        }
    
                        $cursoModel->save();
                    }
                }
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
