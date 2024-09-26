<?php

namespace App\Livewire;

use App\Models\Configuracion;
use App\Models\Horario;
use App\Models\Materia;
use App\Models\User;
use Livewire\Component;

class Horarios extends Component
{
    public $cursoId;
    public $materias;
    public $profesores;
    public $horarioData = [];
    public $buttonDisabled = false;

    public function mount($cursoId, $materiaId = null)
    {
        $this->cursoId = $cursoId;
        $this->materias = Materia::MateriasPorCurso($this->cursoId)->get();
        $this->profesores = User::profesoresPorCurso($this->cursoId)->get();

        $this->horarioData = $this->loadHorarios();
    }

    public function loadHorarios()
    {
        return Horario::where('curso_id', $this->cursoId)
        ->orderBy('hora_inicio')
            ->get()
            ->groupBy('dia')
            ->map(function ($items) {
                return $items->mapWithKeys(function ($item) {
                    return [$item->hora_inicio => [
                        'id' => $item->id,
                        'hora_inicio' => $item->hora_inicio,
                        'hora_fin' => $item->hora_fin,
                        'materia_id' => $item->materia_id,
                        'profesor_id' => $item->profesor_id,
                    ]];
                })->toArray();
            })->toArray();
    }

    public function addHorario($dia)
    {
        $this->horarioData[$dia][] = [
            'hora_inicio' => null,
            'hora_fin' => null,
            'materia_id' => null,
            'profesor_id' => null,
        ];
    }

    public function removeHorario($dia, $hora_inicio)
    {
        if (isset($this->horarioData[$dia])) {
            $horario = collect($this->horarioData[$dia])->firstWhere('hora_inicio', $hora_inicio);

            if ($horario) {
                Horario::where([
                    'hora_inicio' => $hora_inicio,
                    'hora_fin' => $horario['hora_fin'],
                    'dia' => $dia,
                    'curso_id' => $this->cursoId
                ])->delete();

                $this->horarioData[$dia] = array_filter($this->horarioData[$dia], function ($item) use ($hora_inicio) {
                    return $item['hora_inicio'] !== $hora_inicio;
                });
            }
        }
    }

    public function save()
    {
        foreach ($this->horarioData as $dia => $horarios) {
            foreach ($horarios as $data) {
                if (isset($data['id'])) {
                    // Actualiza el horario existente
                    Horario::where('id', $data['id'])->update([
                        'hora_inicio' => $data['hora_inicio'],
                        'hora_fin' => $data['hora_fin'],
                        'materia_id' => $data['materia_id'],
                        'profesor_id' => $data['profesor_id'] ?? null
                    ]);
                } else {
                    // Crea un nuevo horario
                    Horario::create([
                        'hora_inicio' => $data['hora_inicio'],
                        'hora_fin' => $data['hora_fin'],
                        'dia' => $dia,
                        'curso_id' => $this->cursoId,
                        'materia_id' => $data['materia_id'],
                        'profesor_id' => $data['profesor_id'] ?? null
                    ]);
                }
            }
        }
        
        session()->flash('message', 'Horarios actualizados correctamente.');
        $this->buttonDisabled = false;
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
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $dias = $configuracion->dias;
        return view('livewire.horarios', [
            'dias' => $dias,
        ]);
    }
}
