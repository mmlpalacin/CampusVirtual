@extends('layouts.app')
@section('title', 'Materias')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Lista de Materias
    </h1>
    <x-a href="{{route('admin.materias.create')}}">Nueva materia</x-a>
@endsection
@section('content')
@if (session('info'))
        <div class="alert">
            <strong>{{session('info')}}</strong>
        </div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Materia</th>
                    <th>Tipo</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materias as $materia)
                    <tr>
                        <td>{{$materia->id}}</td>
                        <td>{{$materia->name}}</td>
                        <td>{{ ucfirst($materia->tipo) }}</td>
                        <td width="10px"><a href="{{route('admin.materias.edit', $materia)}}" class="btn btn-primary">Editar</a></td>
                        <td width="10px">
                            <form action="{{route('admin.materias.destroy', $materia)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection