@extends('layouts.app')
@section('title','Editar Rol')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Editando Rol
    </h1>
@endsection
@section('content')
    <form action="{{route('admin.roles.update', $role)}}" method="POST">
        @csrf
        @method('put')
        @include('admin.plantillas.roles')
    </form>
@endsection