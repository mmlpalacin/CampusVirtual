@extends('layouts.app')
@section('title', 'Pagos')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Pagos a Cooperadora
    </h1>
@endsection
@section('content')
    <form id="estadoForm" method="GET" action="{{ route('cooperadora.pagos.index') }}">
        <label for="estado">Selecciona un estado:</label>
        <select id="estado" name="estado" class="form-control" onchange="document.getElementById('estadoForm').submit();">
            <option value="">Todos los Pagos</option>
            <option value="aprobado">Pagos aprobados</option>
            <option value="desaprobado">Pagos Desaprobados</option>
            <option value="pendiente">Pagos Pendientes</option>
        </select>
    </form>

    <x-section-border />
    <x-validation-errors/>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Pagos</th>
                    <th>Estado</th>
                    <th>Monto Pendiente</th>
                    <th>Ultimo Comprobante</th>
                    <th colspan="7"></th>
                </tr>
            </thead>
            @foreach ($cooperadoras as $cooperadora)
                <tbody>
                    <tr>
                        <td>{{$cooperadora->user->lastname}}, {{$cooperadora->user->name}}</td>
                        <td>{{ $cooperadora->pagado }}</td>
                        <td>{{ $cooperadora->estado }}</td>
                        <td>{{ $cooperadora->monto_pendiente}}</td>
                        <td>
                            @php
                                $comprobantes = $cooperadora->comprobantes->sortByDesc('updated_at')->first();
                                if(isset($comprobantes) && $comprobantes->updated_at === $cooperadora->updated_at){
                                    $comprobante = $comprobantes;
                                }
                            @endphp
                            @if(isset($comprobante))
                                <a href="{{ asset('storage/comprobantes/' . basename($comprobante->url)) }}" target="_blank">
                                    <img src="{{ asset('storage/comprobantes/' . basename($comprobante->url)) }}" style="width: 25%; height: auto; border-radius: 8px;">
                                </a>
                            @else
                                <x-button id="btncomprobantes" onclick="show('comprobantes')">Ver Comprobantes Anteriores</x-button>
                                <div id="comprobantes" style="display: none;flex-wrap: wrap;gap: 10px;justify-content: center;">
                                @if($cooperadora->comprobantes)
                                        @foreach ($cooperadora->comprobantes as $item)
                                        <a href="{{ asset('storage/comprobantes/' . basename($item->url)) }}" target="_blank">
                                            <img src="{{ asset('storage/comprobantes/' . basename($item->url)) }}" style="width: 100px; height: auto; border-radius: 8px;"">
                                        </a>
                                        @endforeach
                                    @else
                                        <p class="text-center text-l font-bold">No tienes comprobantes aun.</p>
                                    @endif
                                </div>
                            @endif
                        </td>
                        @can('cooperadora.pagos.approve')
                        @if($cooperadora->estado == 'pendiente')
                            <td width="10px">   
                                <form action="{{ route('cooperadora.pagos.approve', $cooperadora) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <x-button>Aprobar Pago</x-button>
                                </form>
                            </td>
                            <td>
                                <button id="desaprobar-{{$cooperadora->id}}" class="btn btn-danger" onclick="show('desaprobado-{{$cooperadora->id}}', 'desaprobar-{{$cooperadora->id}}')">No Aprobar Pago</button>
                                <section id="desaprobado-{{$cooperadora->id}}" style="display: none; padding: 10px; background-color: #f8d7da;">
                                    <form action="{{ route('cooperadora.pagos.disapprove', $cooperadora) }}" method="POST">
                                        @csrf
                                        <x-label for="observacion_field_{{$cooperadora->id}}">¿Por qué no aceptas este pago?</x-label>
                                        <input type="text" id="observacion_field_{{$cooperadora->id}}" name="observacion" required>
                                        <button class="btn btn-danger">Enviar</button>
                                    </form>
                                </section>
                            </td>
                        @endif
                        @endcan
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    
    <script>
        function show(id){
            document.getElementById(id).style.display = 'inline-flex';
            document.getElementById('btn' + id).style.display = 'none';
        }
        function show(sectionId, buttonId) {
            var section = document.getElementById(sectionId);
            var button = document.getElementById(buttonId);
            
            // Toggle the display of the section
            if (section.style.display === 'none' || section.style.display === '') {
                section.style.display = 'block'; // Show the section
                button.style.display = 'none';    // Hide the button
            } else {
                section.style.display = 'none';    // Hide the section
                button.style.display = 'block';     // Show the button
            }
        }
    </script>
@endsection                    