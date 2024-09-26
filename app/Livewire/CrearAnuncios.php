<?php

namespace App\Livewire;

use App\Http\Requests\AnuncioRequest;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;
use Livewire\Component;

class CrearAnuncios extends Component
{
    use WithFileUploads;
    public $newImages = [], $temporaryImagePaths = [];
    public $anuncioId, $title, $body, $status, $curso_id, $user_id;
    public $isUploading;
    public $cursos;

    public function mount($anuncio = null)
    {
        $this->user_id = auth::user()->id;
        if($anuncio){
            $this->anuncioId = $anuncio->id;
            $this->title = $anuncio->title;
            $this->body = $anuncio->body;
            $this->status = $anuncio->status;
            $this->curso_id = $anuncio->curso_id;
        }
        Log::info('Anuncio data:', ['body' => $this->body]);

    }

    private function checkAuthorization()
    {
        if ($this->user_id !== Auth::user()->id) {
            throw ValidationException::withMessages([
                'user' => 'You are not authorized to perform this action.',
            ]);
        }
    }

    public function submit()
    {
        $this->checkAuthorization();
        $this->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'body' => $this->status == 2 ? 'required|string' : 'nullable|string',
            'curso_id' => 'nullable|exists:cursos,id',
            'status' => 'required|in:1,2',
        ]);

        if (isset($this->anuncioId)) {
            $anuncio = Anuncio::where('id', $this->anuncioId)->first();
            $anuncio->update([
                'title' => $this->title,
                'user_id' => $this->user_id,
                'body' => $this->body,
                'status' => $this->status,
                'curso_id' => $this->curso_id,
            ]);
        }else{
            $anuncio = Anuncio::create([
                'title' => $this->title,
                'user_id' => $this->user_id,
                'body' => $this->body,
                'status' => $this->status,
                'curso_id' => $this->curso_id,
            ]);
        }

        if($anuncio->status==2){
            $anuncio->published = now();
        }

        $anuncio->save();
        return redirect()->route('admin.anuncio.index')->with('info', 'El anuncio se creo con exito');
    }

    public function render()
    {
        return view('livewire.crear-anuncios');
    }
}
