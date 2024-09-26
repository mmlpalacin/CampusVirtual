<?php

namespace App\Livewire;

use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListaAnuncios extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
     
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();
        return view('livewire.lista-anuncios', [
            'anuncios' => Anuncio::where('user_id', $user->id)
            ->where('title', 'like', '%'.$this->search.'%')->latest('id')->paginate(),//busca lo similar sin importar lo que est adelante o atras
        ]);
    }
}
