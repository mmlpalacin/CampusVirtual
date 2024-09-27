<?php

namespace App\Http\Controllers\Preceptor;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AsistenciaController extends Controller
{
    public function index(Curso $curso)
    {
        $alumnos = User::alumnosPorCurso($curso->id)->get();

        $turno = request('turno', 'aula');

        $fechas = Asistencia::asistenciaPorA()->select('date')
        ->when($turno == 'taller', function ($query) {
            return $query->where('turno', 'taller');
        })->distinct()->orderBy('date', 'desc')->pluck('date');

        return view('preceptor.asistencia.index', compact('curso','alumnos', 'fechas'));
    }

    public function create(curso $curso)
    {
        $alumnos = User::alumnosPorCurso($curso->id)->get();
        $asistencias =  Asistencia::asistenciaPorA()->get();
        Log::info($asistencias);
        return view('preceptor.asistencia.create', compact('curso', 'alumnos', 'asistencias'));
    }

    public function store(Request $request, Curso $curso)
    {
        $data = $request->validate([
            'asistencias.*.alumno_id' => 'required|exists:users,id',
            'asistencias.*.estado' => 'required|in:presente,tarde,ausente',
            'date' => 'required|date',
            'turno' => 'required|in:aula,taller'
        ]);
    
        foreach ($data['asistencias'] as $asistenciaData) {
            Asistencia::updateOrCreate(
                [
                    'user_id' => $asistenciaData['alumno_id'],
                    'date' => $data['date'],
                    'turno' => $data['turno']
                ],
                [
                    'estado' => $asistenciaData['estado']
                ]
            );
        }
        return redirect()->route('prece.asistencia.index', $curso);
    }
}
