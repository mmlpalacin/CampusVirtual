@extends('layouts.app')
@section('title', 'Mesas De Examen')

@section('content')
<div class="container">
    <div class="flex items-center justify-between mb-4">
        <h1 class="h1">Mesas de Examen</h1>
        @can('admin.mesas.create')
            <a href="{{ route('admin.mesas.create') }}"><x-button class="mr-4">Modificar Mesas</x-button></a>
        @endcan
    </div>
    <br>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($grados as $grado)
            <table class="table table-bordered">
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