@extends('layouts.app')
@section('title', 'Mis Cursos')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Lista de Cursos
    </h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>curso</th>
                        <th>division</th>
                        <th>turno</th>
                        <th>Especialidad</th>
                        <th colspan="5"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                        <tr>
                            <td>{{$curso->name}}</td>
                            <td>{{$curso->division->name}}</td>
                            <td>{{$curso->turno->name}}</td>
                            <td>{{$curso->especialidad->name}}</td>
    
                            @can('admin.horario.edit')
                            <td width="10px"><x-a href="{{ route('horario', $curso) }}">Editar Horario</x-a></td>
                            @endcan
    
                            <td width="10px"><x-a href="{{route('prece.asistencia.create', $curso)}}">Tomar Asistencia</x-a></td>
                            <td width="10px"><a href="{{route('admin.cursos.show', $curso)}}" class="px-4 py-2 rounded-md font-semibold text-xs uppercase btn btn-primary">Ver Curso</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection