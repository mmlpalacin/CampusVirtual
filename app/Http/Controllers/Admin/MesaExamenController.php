<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\MesaExamen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MesaExamenController extends Controller
{
    public function index()
    {
       $mesas = MesaExamen::with('materia','user')->orderBy('grado')->orderBy('fecha')->orderBy('materia_id')
       ->get()
       ->groupBy('grado')
       ->mapWithKeys(function ($items, $grado) {
           return [$grado => $items->map(function ($item) {
               return [
                   'id' => $item->id,
                   'grado' => $item->grado,
                   'hora' => $item->hora,
                   'fecha' => Carbon::parse($item->fecha)->locale('es')->translatedFormat('d F'),
                   'updated_at' => $item->updated_at,
                   'materia_id' => $item->materia->name,
                   'user_id' => $item->user->lastname . ', ' . $item->user->name
               ];
           })->toArray()];
       })->toArray();

       $grados = array_keys($mesas);
        return view('admin.mesas.index', compact('mesas', 'grados'));
    }


    public function create()
    {
        return view('admin.mesas.create');
    }
}
