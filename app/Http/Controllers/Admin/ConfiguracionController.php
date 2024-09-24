<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use illuminate\Http\Request;
use App\Models\Configuracion;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones = Configuracion::all();
        return view('admin.configuracion.index', compact('configuraciones'));
    }

    public function create()
    {
        return view('admin.configuracion.create');
    }

    public function store(Request $request)
    {
        Configuracion::create($request->all());

        return redirect()->route('admin.configuracion.index')->with('success', 'Configuración creada con éxito.');
    }

    public function edit(Configuracion $configuracion)
    {
        return view('admin.configuracion.edit', compact('configuracion'));
    }

    public function update(Request $request, Configuracion $configuracion)
    {
        $configuracion->update($request->all());

        return redirect()->route('admin.configuracion.index')->with('success', 'Configuración actualizada con éxito.');
    }

    public function destroy(Configuracion $configuracion)
    {
        $configuracion->delete();
        return redirect()->route('admin.configuracion.index')->with('success', 'Configuración eliminada con éxito.');
    }
}
