<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicDataRequest;
use App\Http\Requests\AddressContactRequest;
use App\Http\Requests\AnotherDataRequest;
use App\Http\Requests\HealthRequest;
use App\Http\Requests\PersonalDataRequest;
use App\Http\Requests\TutorRequest;
use App\Models\AdultosResponsables;
use App\Models\Ciudad;
use App\Models\Configuracion;
use App\Models\Genero;
use App\Models\Inscripcion;
use App\Models\Pais;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function index()
    {
        $user = auth::user();
        $paises = Pais::all();
        $provincias = Provincia::all();
        $partidos = Partido::all();
        $ciudades = Ciudad::all();
        $generos = genero::all();
        $inscripcion = Inscripcion::where('user_id', $user->id)->first();
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $grados = $configuracion->grados;
        $editable = false;
        return view('alumno.index', compact('editable', 'grados', 'inscripcion','user', 'paises', 'provincias', 'partidos', 'ciudades', 'generos'));
    }

    public function form1(Inscripcion $inscripcion){
        $editable = true;
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $grados = $configuracion->grados;
        $inscripcion = Inscripcion::where('user_id', auth::user()->id)->first();

        if (!$inscripcion) {
            return redirect()->route('alumno.datos.index')->withErrors('Inscription not found.');
        }
        return view('alumno.inscripcion.form', compact('editable', 'grados', 'inscripcion'));
    }

    public function form1Store(Inscripcion $inscripcion = null, AcademicDataRequest $request)
    {     
        $inscripcion = Inscripcion::where('user_id', auth::user()->id)->first();
        if($inscripcion === null){
            Log::info('dd' . json_encode($request->all()));
            $inscripcion = Inscripcion::create($request->all() + ['user_id' => auth::user()->id]);
        }else{
            Log::info('i' . json_encode($request->all()));

            $inscripcion->update($request->all());
        }
        
        return redirect()->route('alumno.datos.form2', compact('inscripcion'));
    }

    public function form2(Inscripcion $inscripcion)
    {    
        $generos = Genero::all();
        $editable = true;
        return view('alumno.inscripcion.form2', compact('generos', 'editable', 'inscripcion'));
    }

    public function form2Store(User $user, PersonalDataRequest $request, Inscripcion $inscripcion)
    {
        $inscripcion->update($request->all());
        
        return redirect()->route('alumno.datos.form3', compact('inscripcion'));
    }

    public function form3(Inscripcion $inscripcion)
    {
        $paises = Pais::all();
        if($inscripcion->pais_id === null){
            $provincias = [];
            $partidos = [];
            $ciudades = [];
        }else{
            $provincias = Provincia::all();
            $partidos = Partido::all();
            $ciudades = Ciudad::all();
        }
        $editable = true;
        return view('alumno.inscripcion.form3', compact('inscripcion', 'editable','paises', 'provincias', 'partidos', 'ciudades'));
    }

    public function Form3store(Inscripcion $inscripcion, AddressContactRequest $request)
    {
        $inscripcion->update($request->all());

        return redirect()->route('alumno.datos.form4', compact('inscripcion'));
    }

    public function form4(Inscripcion $inscripcion)
    {
        $editable = true;
        return view('alumno.inscripcion.form4', compact('inscripcion', 'editable'));
    }

    public function Form4store(Inscripcion $inscripcion, AnotherDataRequest $request)
    {
        $inscripcion->update($request->all());

        $editable = false;
        return redirect()->route('alumno.datos.form5', compact('inscripcion'));
    }
    
    public function form5(Inscripcion $inscripcion)
    {
        $editable = true;
        return view('alumno.inscripcion.form5', compact('inscripcion', 'editable'));
    }

    public function Form5store(Inscripcion $inscripcion, HealthRequest $request)
    {
        $inscripcion->update($request->all());

        return redirect()->route('alumno.datos.padres', compact('inscripcion'));
    }

    public function Padres(Inscripcion $inscripcion)
    {
        $padres = AdultosResponsables::where('inscripcion_id', $inscripcion->id)->get();
        $paises = Pais::all();    
        $provincias = [];
        $partidos = [];
        $ciudades = [];

        $editable = true;
        return view('alumno.inscripcion.padres', compact('editable', 'padres','paises', 'provincias', 'partidos', 'ciudades'));
    }

    public function PadresStore(AdultosResponsables $padres, TutorRequest $request)
    {
        $inscripcion = Inscripcion::where('user_id', auth::user()->id)->first();
        $padres = AdultosResponsables::where('inscripcion_id', $inscripcion->id)->get();

        foreach (['padre', 'madre', 'tutor'] as $tipo) {
            $data = $request->input(strtolower($tipo));
    
            if ($data) {
                $data['tipo'] = strtolower($tipo);
                $data['inscripcion_id'] = $inscripcion->id;
    
                $existingPadre = $padres->where('tipo', $data['tipo'])->first();

                if ($existingPadre) {
                    $existingPadre->update($data);
                }else{
                    AdultosResponsables::Create($data);
                }
            }
        }
        $editable = false;
        return redirect()->route('alumno.datos.index', compact('editable', 'inscripcion'))->with('success', 'Alumno updated successfully.');
    }

    public function getProvincias($paisId)
    {
        $provincias = Provincia::where('pais_id', $paisId)->get();
        return response()->json($provincias);
    }

    public function getPartidos($provinciaId)
    {
        $partidos = Partido::where('provincia_id', $provinciaId)->get();
        return response()->json($partidos);
    }

    public function getCiudades($partidoId)
    {
        $ciudades = Ciudad::where('partido_id', $partidoId)->get();
        return response()->json($ciudades);
    }

    public function imprimir(Inscripcion $inscripcion)
    {
        $user = Auth::user();
        $paises = Pais::all();
        $provincias = Provincia::all();
        $partidos = Partido::all();
        $ciudades = Ciudad::all();
        $generos = Genero::all();
        $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
        $grados = $configuracion->grados;
        $inscripcion = Inscripcion::where('user_id', $user->id)->first();
        $padres = AdultosResponsables::where('inscripcion_id', $inscripcion->id);
        $editable = false;
        $pdf = Pdf::loadView('alumno.imprimir', compact('editable', 'grados', 'padres', 'inscripcion','user', 'paises', 'provincias', 'partidos', 'ciudades', 'generos'));
        return $pdf->stream('ficha_de_inscripcion.pdf');
    }
}
