@extends('layouts.app')
@section('title', 'Configuracion')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Configuracion
    </h1>
@endsection
@section('content')
<div class="container">
    <div class="flex items-center justify-between mb-4">
        <h1 class="h1">Configuraciones</h1>
        <a href="{{ route('admin.configuracion.create') }}" class="btn btn-primary mr-4">Agregar Configuración</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Ciclo Lectivo</th>
                <th>Monto Cooperadora</th>
                <th>Hora Inicio Escuela</th>
                <th>Hora Fin Escuela</th>
                <th>Tipo de Evaluación</th>
                <th colspan="5"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($configuraciones as $configuracion)
                <tr>
                    <td>{{ $configuracion->ciclo_lectivo }}</td>
                    <td>{{ $configuracion->monto_cooperadora }}</td>
                    <td>{{ $configuracion->hora_inicio_escuela }}</td>
                    <td>{{ $configuracion->hora_fin_escuela }}</td>
                    <td>{{ $configuracion->tipo_evaluacion }}</td>
                    <td>
                        <a href="{{ route('admin.configuracion.edit', $configuracion) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.configuracion.destroy', $configuracion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection