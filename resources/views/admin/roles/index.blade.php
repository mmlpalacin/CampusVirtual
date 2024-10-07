@extends('layouts.app')
@section('title', 'Roles')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Lista de Roles
    </h1>
    <x-a href="{{route('admin.roles.create')}}">Nuevo Rol</x-a>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            <strong>{{session('success')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td width="10px"><a href="{{route('admin.roles.edit', $role)}}" class="btn btn-primary">Editar</a></td>
                            <td width="10px">
                                <form action="{{route('admin.roles.destroy', $role)}}" method="post">
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