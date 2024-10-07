<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Configuracion;
use App\Models\Cooperadora;
use App\Models\Horario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function welcome()
    {
        $users = User::role('admin')->pluck('id');
        $anuncios = Anuncio::where('status', 2)
            ->whereIn('user_id', $users)
            ->latest('published')
            ->paginate();

        $user = Auth::user();

        if ($user && ($user->hasrole('profesor') || $user->hasrole('preceptor'))) {
            $cursos = $user->cursos;

            if ($cursos->isNotEmpty()) {
                $anunciosCurso = Anuncio::where('status', 2)
                    ->whereIn('curso_id', $cursos->pluck('id'))
                    ->latest('published')
                    ->get();

                $anuncios = $anuncios->merge($anunciosCurso)->sortByDesc('published');
            } 
        }elseif ($user && $user->hasrole('alumno')) {
            $cursoInscripcion = $user->inscripcion->curso;
            if ($cursoInscripcion) {
                $anunciosCurso = Anuncio::where('status', 2)
                    ->where('curso_id', $cursoInscripcion->id)
                    ->latest('published')
                    ->get();

                $anuncios = $anuncios->merge($anunciosCurso)->sortByDesc('published');
            }
        }

        return view('welcome', compact('anuncios'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $role = optional($user->roles->first())->name;
        if($role === 'alumno'){
            $curso = $user->inscripcion->curso;
            if (!$curso) {
                return view('dashboard', compact('role'));
            }
            $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
            $cooperadora = Cooperadora::where('user_id', $user->id)->where('configuracion_id', $configuracion->id)->first();
            
            if($cooperadora && $curso){
                $montoCooperadora = null;
                if (!is_null($configuracion) && is_iterable($configuracion->cooperadora)) {
                    foreach ($configuracion->cooperadora as $item) {
                        if (in_array($curso->name, $item['grados'])) {
                            $montoCooperadora = $item['montos'][0];
                            break;
                        }
                    }
                }
            
                return view('dashboard', compact('role', 'curso', 'configuracion', 'cooperadora', 'montoCooperadora'));
            }
        }elseif($role === 'profesor' || $role === 'preceptor'){
            $cursos = $user->cursos;
            return view('dashboard', compact('role', 'cursos'));
        }else{
            return view('dashboard', compact('role'));
        }
    }
}
