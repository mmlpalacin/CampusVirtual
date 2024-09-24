<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsersIndex extends Component
{
    use WithPagination;
    
    public $search = '';
    public $role = "";

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $roles = Role::all();
        $usersQuery = User::query()->with('roles');

        if ($this->role) {
            $usersQuery->role($this->role);
        }

        $usersQuery->where(function ($query) {
            $query->where('email', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%')
                ->orWhere('lastname', 'like', '%'.$this->search.'%');
        });

        $users = $usersQuery->latest('id')->paginate();
    
        return view('livewire.users-index', compact('users', 'roles'));
    }
}
