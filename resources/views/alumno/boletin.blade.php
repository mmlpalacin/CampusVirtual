@extends('layouts.app')
@section('title', 'Boletin')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Boletin
    </h1>
@endsection
@section('content')
    <div class="container d-flex flex-column bg-white justify-content-center align-items-center">
        <h1 class="h3 pt-2">ESCUELA DE EDUCACIÓN SECUNDARIA TÉCNICA N°3</h1>
        <thead>
            <table class="table">
                <tr>
                    <th>Alumno/a: {{$user->lastname}}, {{$user->name}}</th>
                    <th>Curso: {{$user->inscripcion->curso->name}}</th>
                    <th>DIV: {{$user->inscripcion->curso->division->name}}</th>
                    <th>Orientación: {{$user->inscripcion->curso->especialidad->name}}</th>
                    <th>Ciclo Lectivo {{$configuracion->ciclo_lectivo}}</th>
                </tr>
                <tr>
                    <th>Materia</th>
                    <th>1er Avance</th>
                    <th>1er Cuatrimestre</th>
                    <th>2do Avance</th>
                    <th>2do Cuatrimestre</th>
                    <th>Promedio Final</th>
                </tr>
                </thead>
                <tbody class="bg-grey-500">
                    @foreach($materias as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            @php 
                                $promediosPorBimestre = [];
                                $promedioTotal = 0;
                                $cantidadBimestres = 0;

                                for ($bimestre = 1; $bimestre <= 4; $bimestre++) {
                                    $notasBimestre = $item->notas->where('boletin_id', $boletin->id)->where('bimestre', $bimestre);
                                    
                                    if ($notasBimestre->isEmpty()) {
                                        $promediosPorBimestre[$bimestre] = '';
                                        continue;
                                    }
                                    
                                    $sumaNotas = 0;
                                    $cantidadNotas = 0;

                                    foreach ($notasBimestre as $nota) {
                                        $notasDecodificadas = json_decode($nota->notas, true);
                                        
                                        foreach ($notasDecodificadas as $notaIndividual) {
                                            $sumaNotas += (float) $notaIndividual['nota'];
                                            $cantidadNotas++;
                                        }
                                    }

                                    $promedioBimestre = $cantidadNotas > 0 ? $sumaNotas / $cantidadNotas : 0;
                                    $promediosPorBimestre[$bimestre] = $promedioBimestre;

                                    if ($configuracion->tipo_evaluacion === 'letras') {
                                        if ($promedioBimestre > 7) {
                                            $promediosPorBimestre[$bimestre] = 'TEA';
                                        } elseif ($promedioBimestre >= 4) {
                                            $promediosPorBimestre[$bimestre] = 'TEP';
                                        } else {
                                            $promediosPorBimestre[$bimestre] = 'TED';
                                        }
                                    }

                                    $promedioTotal += $promedioBimestre;
                                    $cantidadBimestres++;
                                }

                                foreach ($promediosPorBimestre as $promedio) {
                                    echo "<td>" . (is_numeric($promedio) ? number_format($promedio, 2) : $promedio) . "</td>";
                                }

                                $promedioFinal = $cantidadBimestres > 0 ? number_format($promedioTotal / $cantidadBimestres, 2) : 0;

                                echo "<td>{$promedioFinal}</td>";
                            @endphp      
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Inasistencias</th>
                        <th>{{ $total }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
@endsection