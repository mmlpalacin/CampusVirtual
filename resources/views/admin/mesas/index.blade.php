@extends('layouts.app')
@section('title', 'Mesas De Examen')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Mesas de Examen
    </h1>
    @can('admin.mesas.create')
        <a href="{{ route('admin.mesas.create') }}"><x-button class="mr-4">Modificar Mesas</x-button></a>
    @endcan
@endsection
@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($grados as $grado)
            <table class="table bg-white">
                <thead>
                    <tr>
                        <th>Año</th>
                        <th>Materia</th>
                        <th>Hora</th>
                        <th>Fecha</th>
                        <th>Profesor</th>
                        <th>Ultima Actualización</th>
                    </tr>
                </thead>
                @if(isset($mesas[$grado]))
                @foreach ($mesas[$grado] as $index => $mesa)
                    <tbody>
                        <tr>
                            <td>{{ $mesa['grado'] }}</td>
                            <td>{{ $mesa['materia_id'] }}</td>
                            <td>{{ $mesa['hora'] }}</td>
                            <td>{{ $mesa['fecha'] }}</td>
                            <td>{{ $mesa['user_id'] }}</td>
                            <td>{{ $mesa['updated_at'] }}</td>
                        </tr>
                    </tbody>
                @endforeach
                @endif
            </table>
            <x-section-border/>
        @endforeach

    @if(empty($grados))
        <div class="alert alert-info">
            No hay mesas de examen registradas.
        </div>
    @endif
</div>
@endsection