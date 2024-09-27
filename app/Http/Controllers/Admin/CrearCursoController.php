<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Curso;
use App\Models\Division;
use App\Models\Especialidad;
use App\Models\Horario;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Http\Request;

class CrearCursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return view('admin.cursos.index', compact('cursos'));
    }

    public function create()
    {
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $grados = $configuracion->grados;
        $especialidades = Especialidad::all();
        $divisiones = Division::orderbyRaw('CAST(name AS UNSIGNED)')->get();
        $turnos = Turno::all();

        return view('admin.cursos.create', compact('grados', 'especialidades', 'divisiones', 'turnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'especialidad_id' => 'required|exists:especialidad,id',
            'division_id' => 'required|exists:division,id',
            'turno_id' => 'required|exists:turnos,id',
        ]);

        Curso::create($request->all());

        return redirect()->route('admin.cursos.index')->with('info', 'El curso se creo con éxito');
    }

    public function show(curso $curso)
    {
        $alumnos = User::AlumnosPorCurso($curso->id)->get();
        $horas = Horario::where('curso_id', $curso->id)->select('hora_inicio', 'hora_fin')
            ->distinct()
            ->orderBy('hora_inicio')
            ->get();
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $dias = $configuracion->dias;
        $horarios = Horario::with('materia', 'profesor')
            ->get()
            ->groupBy('dia');

        $curso = Curso::with(['anuncio' => function($query) {
                $query->orderBy('published', 'desc');
            }])->find($curso->id);

        return view('preceptor.curso', compact('curso', 'alumnos', 'horas', 'dias', 'horarios'));
    }

    public function edit(Curso $curso)
    {
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $grados = $configuracion->grados;
        $especialidades = Especialidad::all();
        $divisiones = Division::orderbyRaw('CAST(name AS UNSIGNED)')->get();
        $turnos = Turno::all();

        return view('admin.cursos.edit', compact('grados', 'curso', 'especialidades', 'divisiones', 'turnos'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'name' => 'required',
            'especialidad_id' => 'required|exists:especialidad,id',
            'division_id' => 'required|exists:division,id',
            'turno_id' => 'required|exists:turnos,id',
        ]);

        $curso->update($request->all());

        return redirect()->route('admin.cursos.index')->with('info', 'El curso se actualizo con éxito');
    }

    public function destroy(curso $curso)
    {
        $curso->delete();

        return redirect()->route('admin.cursos.index')->with('info', 'Se elimino el curso con éxito');
    }
}
