<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Inscripcion;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    protected $creator;

    public function __construct(CreateNewUser $creator)
    {
        $this->creator = $creator;
    }
    public function index()
    {
        return view('admin.users.index');
    }
    public function create()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function store(Request $request)
    {
        if (config('fortify.lowercase_usernames')) {
            $request->merge([
                Fortify::username() => Str::lower($request->{Fortify::username()}),
            ]);
        }

        $this->creator->create($request->all());

        return redirect()->route('admin.users.index')->with('info', 'Usuario creado exitosamente.');;
    }

    public function edit(User $user)
    {
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();

        return view ('admin.users.edit', compact('user', 'configuracion'));
    }

    public function destroy(user $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('info','El usuario se elimino con exito');
    }
}
