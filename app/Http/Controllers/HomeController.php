<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Cooperadora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->roles->first()->name;
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $cooperadora = Cooperadora::where('user_id', $user->id)->where('configuracion_id', $configuracion->id)->first();
        if($cooperadora){
            $gradoAlumno = $user->inscripcion->curso->name;
            $montoCooperadora = null;
            foreach ($configuracion->cooperadora as $item) {
                if (in_array($gradoAlumno, $item['grados'])) {
                    $montoCooperadora = $item['montos'][0];
                    break;
                }
            }
            return view('dashboard', compact('role', 'configuracion', 'cooperadora', 'montoCooperadora'));
        }else{
            return view('dashboard', compact('role', 'configuracion'));
        }
        return view('dashboard', compact('role'));
    }
}
