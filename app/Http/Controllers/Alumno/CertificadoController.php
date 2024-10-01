<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'curso' =>  $user->inscripcion->curso->name . '°' . $user->inscripcion->curso->division->name . ', ' . $user->inscripcion->curso->especialidad->name,
            'turno' => $user->inscripcion->curso->turno,
            'dia' => date('d'),
            'mes' => \Carbon\Carbon::now()->locale('es')->translatedFormat('F'),
            'year' => date('Y'),
            'autoridad' => $request->input('autoridades')
        ];

        $pdf = Pdf::loadView('alumno.certificado', ['user' =>$user]);

        return $pdf->stream('certificado_alumno.pdf');
    }
}
