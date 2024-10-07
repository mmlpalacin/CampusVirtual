<?php

namespace App\Livewire;

use App\Models\Boletin;
use App\Models\Configuracion;
use App\Models\Nota;
use App\Models\User;
use Livewire\Component;

class Notas extends Component
{
    public $alumnos, $boletin;
    public $materiaId;
    public $notasData = [], $nuevaNota, $tiposNotas = [];
    public $buttonDisabled = false;
    public $mostrarCampo = [ 'nota' => false ];

    public function mount($curso, $materiaId)
    {
        $this->alumnos = User::alumnosPorCurso($curso->id)->get();
        $this->materiaId = $materiaId;
        $this->loadNotas();
    }

    public function loadNotas()
    {
        foreach ($this->alumnos as $alumno) {
            $this->boletin = Boletin::UltimoBoletin($alumno->id);
            if($this->boletin === null){
                $this->boletin = Boletin::create([
                    'user_id' => $alumno->id,
                    'curso_id' => $alumno->inscripcion->curso->id,
                    'ciclo_lectivo' => Configuracion::latest('id')->first()->id,
                ]);
            }
            for ($bimestre = 1; $bimestre <= 4; $bimestre++) {
                $nota = Nota::where('boletin_id', $this->boletin->id)
                    ->where('materia_id', $this->materiaId)
                    ->where('bimestre', $bimestre)
                    ->first();
                if ($nota) {
                    $this->notasData[$alumno->id][$bimestre] = json_decode($nota->notas, true);
                    foreach ($this->notasData[$alumno->id][$bimestre] as $notaItem) {
                        $this->tiposNotas[$bimestre][] = $notaItem['nombre'];
                    }
                }else{
                    $this->notasData[$alumno->id][$bimestre] = [];
                    $this->tiposNotas[$bimestre] = [];
                }
            }
        }

        foreach ($this->tiposNotas as $bimestre => $nombres) {
            $this->tiposNotas[$bimestre] = array_unique($nombres);
        }    
    }

    public function mostrarCampoNuevo($campo, $bimestre)
    {
        $this->mostrarCampo[$campo][$bimestre] = true;
    }
    
    public function agregarNota($bimestre)
    {
        foreach ($this->alumnos as $alumno) {
            if (!isset($this->notasData[$alumno->id][$bimestre])) {
                $this->notasData[$alumno->id][$bimestre] = [];
            }

            if (!empty($this->nuevaNota)) {
                $this->notasData[$alumno->id][$bimestre][] = [
                    'nombre' => $this->nuevaNota,
                    'nota' => [],
                ];
            }
            if (!isset($this->tiposNotas[$bimestre])) {
                $this->tiposNotas[$bimestre] = [];
            }
            foreach ($this->notasData[$alumno->id][$bimestre] as $notaItem) {
                if (is_array($notaItem) && isset($notaItem['nombre'])) {
                    $this->tiposNotas[$bimestre][] = $notaItem['nombre'];
                }
            }
        }

        $this->nuevaNota = '';
        $this->mostrarCampo['nota'][$bimestre] = false;
    }

    public function save()
    {
        foreach ($this->alumnos as $alumno) {
            $this->boletin = Boletin::UltimoBoletin($alumno->id);
            for ($bimestre = 1; $bimestre <= 4; $bimestre++) {
                if (isset($this->notasData[$alumno->id][$bimestre])) {
                    $notasFiltradas = array_filter($this->notasData[$alumno->id][$bimestre], function ($nota) {
                        return !empty($nota['nota']);
                    });

                    if (!empty($notasFiltradas)) {
                        Nota::updateOrCreate(
                            [
                                'materia_id' => $this->materiaId,
                                'boletin_id' => $this->boletin->id,
                                'bimestre' => $bimestre,
                            ],
                            [
                                'notas' => json_encode($notasFiltradas),
                            ]
                        );
                    }
                }
            }
        }
        
        $this->buttonDisabled = false;
        session()->flash('message', 'Notas actualizadas exitosamente.');
    }

    public function handleClick()
    {
        if ($this->buttonDisabled) {
            return;
        }

        $this->buttonDisabled = true;
        $this->save();
    }

    public function render()
    {
        return view('livewire.notas');
    }
}
