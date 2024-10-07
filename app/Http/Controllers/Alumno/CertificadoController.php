<?php

namespace App\Http\Controllers\Alumno;

use App\Models\User;
use App\Models\Materia;
use App\Models\Boletin;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CertificadoController extends Controller
{
    public function certificado(Request $request, User $user)
    {
        $request->validate([
            'autoridades' => 'required'
        ]);
        $user = Auth::user();

        $user = [
            'name' => $user->lastname . ', ' . $user->name,
            'curso' =>  $user->inscripcion->curso->name . ' ' . $user->inscripcion->curso->division->name . ', ' . $user->inscripcion->curso->especialidad->name,
            'turno' => $user->inscripcion->curso->turno->name,
            'dia' => date('d'),
            'mes' => \Carbon\Carbon::now()->locale('es')->translatedFormat('F'),
            'year' => date('Y'),
            'autoridad' => $request->input('autoridades')
        ];

        $pdf = Pdf::loadView('alumno.certificado', ['user' =>$user]);

        return $pdf->stream('certificado_alumno.pdf');
    }

    public function boletin(User $user)
    {
        $asistencias = $user->asistencias;
        if($asistencias){
            $ausencias = $asistencias->filter(function ($asistencia) {
                return $asistencia->estado === 'ausente';
            })->count();
        
            $tardanzas = $asistencias->filter(function ($asistencia) {
                return $asistencia->estado === 'tarde';
            })->count();
        
            $total = ($ausencias * 0.5) + ($tardanzas * 0.25);
        }else{
            $total = 0;
        }

        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $materias = Materia::MateriasPorCurso($user->inscripcion->curso->id)->get();
        $boletin = Boletin::UltimoBoletin($user->id);

        return view('alumno.boletin', compact('configuracion','boletin', 'total', 'user', 'materias'));
    }
}
