<?php

namespace App\Livewire;

use App\Models\Imagen;
use Livewire\Component;
use App\Models\Cooperadora as ModelCooperadora;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Cooperadora extends Component
{
    use WithFileUploads;

    public $monto;
    public $image;
    public $cooperadora;

    protected $rules = [
        'monto' => 'required|numeric|min:0',
        'image' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ];

    public function mount($cooperadora)
    {
        $this->cooperadora = $cooperadora;
    }

    public function submit()
    {
        $this->validate();

        if ($this->image) {
            $path = $this->image->store('comprobantes', 'public');

            if ($path) {
                Imagen::create([
                    'url' => Storage::url($path),
                    'imageable_id' => $this->cooperadora->id,
                    'imageable_type' => ModelCooperadora::class,
                ]);
            }
        }

        $this->cooperadora->update([
            'monto_pendiente' => $this->cooperadora->monto_pendiente + $this->monto,
            'estado' => 'pendiente',
            'observacion' => '',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pago registrado correctamente, en espera de confirmación.');
    }

    public function render()
    {
        return view('livewire.cooperadora');
    }
}
