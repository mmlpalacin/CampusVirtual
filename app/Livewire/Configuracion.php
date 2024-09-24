<?php

namespace App\Livewire;

use Livewire\Component;

class Configuracion extends Component
{
    public $configuracionId;
    public $name;
    public $direccion;
    public $telefono;
    public $ciclo_lectivo;
    public $monto_cooperadora;
    public $hora_inicio_escuela;
    public $hora_fin_escuela;
    public $tipo_evaluacion;
    public $grados;
    public $cooperadora;
    public $jornadas;
    public $dias;
    public function mount($configuracion = null)
    {
        if ($configuracion) {
            $this->configuracionId = $configuracion->id;
            $this->name = $configuracion->name;
            $this->direccion = $configuracion->direccion;
            $this->telefono = $configuracion->telefono;
            $this->ciclo_lectivo = $configuracion->ciclo_lectivo;
            $this->monto_cooperadora = $configuracion->monto_cooperadora;
            $this->hora_inicio_escuela = $configuracion->hora_inicio_escuela;
            $this->hora_fin_escuela = $configuracion->hora_fin_escuela;
            $this->tipo_evaluacion = $configuracion->tipo_evaluacion;
            $this->grados = $configuracion->grados;
            $this->cooperadora = $configuracion->cooperadora;
            $this->jornadas = $configuracion->jornadas;
            $this->dias = $configuracion->dias;
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:45',
            'telefono' => 'nullable|string|max:45',
            'ciclo_lectivo' => 'required|integer|unique:configuracions,ciclo_lectivo,' . $this->configuracionId,
            'grados' => 'required|json',
            'cooperadora' => 'nullable|json',
            'jornadas' => 'nullable|json',
            'dias' => 'required|json',
            'hora_inicio_escuela' => 'required|date_format:H:i',
            'hora_fin_escuela' => 'required|date_format:H:i',
            'tipo_evaluacion' => 'required|in:numerica,letras',
        ];
    }

    public function submit()
    {
        $this->validate();

        Configuracion::where('id', $this->configuracionId)->update([
            'name' => $this->name,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'ciclo_lectivo' => $this->ciclo_lectivo,
            'monto_cooperadora' => $this->monto_cooperadora,
            'hora_inicio_escuela' => $this->hora_inicio_escuela,
            'hora_fin_escuela' => $this->hora_fin_escuela,
            'tipo_evaluacion' => $this->tipo_evaluacion,
            'grados' => $this->grados,
            'cooperadora' => $this->cooperadora,
            'jornadas' => $this->jornadas,
            'dias' => $this->dias,
        ]);

        session()->flash('message', 'Configuración actualizada correctamente.');
    }

    public function render()
    {
        return view('livewire.configuracion');
    }
}
