<?php

namespace App\Livewire;

use App\Models\Configuracion;
use App\Models\Materia;
use Livewire\Component;
use App\Models\MesaExamen as ModelMesaExamen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MesaExamen extends Component
{ 
    public $profesores;
    public $materias;
    public $mesas = [];
    public $buttonDisabled = false;
    public $grados = []; 
    public $mostrarCampo = ['newgrado' => false];
    public $newgrado;

    public function mount()
    {
        $this->profesores = User::role('profesor')->get();
        $this->materias = Materia::all();
        $this->mesas = $this->loadMesas();

        $this->grados = array_keys($this->mesas);
    }

    public function loadMesas()
    {
        return ModelMesaExamen::orderBy('grado')->orderBy('fecha')->orderBy('materia_id')
            ->get()
            ->groupBy('grado')
            ->mapWithKeys(function ($items, $grado) {
                return [$grado => $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'grado' => $item->grado,
                        'hora' => $item->hora,
                        'fecha' => Carbon::parse($item->fecha)->format('Y-m-d'),
                        'materia_id' => $item->materia_id,
                        'user_id' => $item->user_id,
                    ];
                })->toArray()];
            })->toArray();
    }

    public function mostrarCampoNuevo($campo)
    {
            $this->mostrarCampo[$campo] = true;
    }

    public function addgrado($grado = null)
    {
        Log::info('grado:', ['grado' => $grado]);

        if ($grado) {
            $this->newgrado = $grado;
            Log::info('crear:', ['grado' => $this->newgrado]);

            if (!isset($this->mesas[$this->newgrado])) {
                $this->mesas[$this->newgrado] = [];
                $this->grados[] = $this->newgrado;
            }
        }
        
        $this->mostrarCampo = ['newgrado' => false];
        $this->newgrado = null;
    }

    public function addMesa($grado)
    {
        $this->mesas[$grado][] = [
            'grado' => $grado,
            'hora' => null,
            'fecha' => null,
            'materia_id' => null,
            'user_id' => null
        ];
    }

    public function removeMesa($grado, $fecha)
    {
        if (isset($this->mesas[$grado])) {
            $mesa = collect($this->mesas[$grado])->firstWhere('fecha', $fecha);

            if ($mesa) {
                ModelMesaExamen::where([
                    'grado' => $grado,
                    'hora' => $mesa['hora'],
                    'fecha' => $mesa['fecha'],
                    'materia_id' => $mesa['materia_id'],
                    'user_id' => $mesa['user_id'],
                ])->delete();

                $this->mesas[$grado] = array_filter($this->mesas[$grado], function ($item) use ($mesa) {
                    return $item !== $mesa;
                });
            }
        }
    }

    public function save()
    {
        foreach ($this->mesas as $grado => $mesas) {
            foreach ($mesas as $mesa) {
                Log::info('Saving mesa:', ['grado' => $grado, 'mesa' => $mesa]);

                if (isset($mesa['id'])) {
                    ModelMesaExamen::where('id', $mesa['id'])->update([
                        'grado' => $grado,
                        'hora' => $mesa['hora'],
                        'fecha' => $mesa['fecha'],
                        'materia_id' => $mesa['materia_id'],
                        'user_id' => $mesa['user_id'],
                    ]);
                } else {
                    ModelMesaExamen::create([
                        'grado' => $grado,
                        'hora' => $mesa['hora'],
                        'fecha' => $mesa['fecha'],
                        'materia_id' => $mesa['materia_id'],
                        'user_id' => $mesa['user_id'],
                    ]);
                }
            }
        }
        
        $this->buttonDisabled = false;
        return redirect()->route('admin.mesas.index')->with('success', 'Mesas actualizadas con exito');
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

        return view('livewire.mesa-examen', compact('configuracion'));
    }
}
