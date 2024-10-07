<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return view('admin.materias.index', compact('materias'));
    }

    public function create()
    {
        return view('admin.materias.create');
    }

    public function store(request $request)
    {
        $request->validate([
            'name' => 'required',
            'tipo' => 'required|in:aula,taller',
        ]);

        Materia::create(['name' => $request->input('name'),'tipo' => $request->input('tipo')]);

        return redirect()->route('admin.materias.index')->with('info', 'Materia creada con exito');
    }

    public function edit(Materia $materia)
    {
        return view('admin.materias.edit', compact('materia'));
    }

    public function update(request $request, Materia $materia)
    {
        $request->validate([
            'name' => 'required',
            'tipo' => 'required|in:aula,taller',
        ]);

        $materia->update(['name' => $request->input('name'),'tipo' => $request->input('tipo')]);

        return redirect()->route('admin.materias.index')->with('info', 'Materia actualizada con exito');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('admin.materias.index')->with('info', 'Se elimino la materia con éxito');
    }
}
