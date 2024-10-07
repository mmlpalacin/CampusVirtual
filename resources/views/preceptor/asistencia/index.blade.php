@extends('layouts.app')
@section('title', 'Asistencia')
@section('header')
    <x-a href="{{route('admin.cursos.show', $curso)}}">Volver al Curso</x-a>
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Lista de Asistencias: {{ request('turno', 'aula') === 'taller' ? 'Taller' : 'Aula' }}
    </h1>
    <x-a href="{{route('prece.asistencia.create', $curso)}}">Tomar Asistencia</x-a>
@endsection
@section('content')
<form method="GET" action="{{ route('prece.asistencia.index', $curso) }}">
    <label class="switch">
        <input type="checkbox" name="turno" value="taller" onchange="this.form.submit()" {{ request('turno') == 'taller' ? 'checked' : '' }}>
        <span class="slider">
            <span class="labels aula-label">Aula</span>
            <span class="labels taller-label">Taller</span>
        </span>
    </label>
</form>
<x-section-border/>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Alumno</th>
            @foreach ($fechas as $fecha)
                <th>{{ $fecha }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($alumnos as $alumno)
            <tr>
                <td>{{ $alumno->lastname }}, {{ $alumno->name }}</td>
                @foreach ($fechas as $fecha)
                    @php
                        $asistencia = $alumno->asistencias->where('turno', request('turno', 'aula'))->firstWhere('date', $fecha);
                        $estado = $asistencia ? $asistencia->estado : 'Not Recorded';
                    @endphp
                    <td>{{ $estado }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@endsection