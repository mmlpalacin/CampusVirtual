<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Cooperadora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CooperadoraController extends Controller
{
    public function index()
    {
        $estado = request('estado');

        $ultimoCicloLectivo = Configuracion::latest('ciclo_lectivo')->first();
        $configuracionId = $ultimoCicloLectivo ? $ultimoCicloLectivo->id : null;

        $cooperadoras = Cooperadora::with('user')
        ->where('configuracion_id', $configuracionId)
        ->when($estado, function ($query) use ($estado) {
            $query->where('estado', $estado);
        })
        ->get();
        
        return view('cooperadora.index', compact('cooperadoras')); 
    }

    public function approve(Cooperadora $cooperadora)
    {
        if ($cooperadora->estado === 'pendiente') {
            $montoAprobar = $cooperadora->monto_pendiente;
    
            if ($montoAprobar > 0) {
                $cooperadora->update([
                    'pagado' => $cooperadora->pagado + $montoAprobar,
                    'monto_pendiente' => 0,
                    'estado' => 'aprobado',
                ]);
            $cooperadora->save();
            }
        }
    
        return redirect()->route('cooperadora.pagos.index')->with('info', 'El pago fue aprobado');
    }
    

    public function disapprove(Request $request, Cooperadora $cooperadora)
    {
        if ($cooperadora->estado === 'pendiente') {
            $cooperadora->update([
                'monto_pendiente' => 0,
                'observacion' => $request->input('observacion'),
                'estado' => 'desaprobado',
            ]);
        }
        return redirect()->route('cooperadora.pagos.index')->with('info', 'El pago fue desaprobado');
    }
}