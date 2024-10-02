@extends('layouts.app')
@section('title','Crear Rol')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Creando Nuevo Rol
    </h1>
@endsection
@section('content')
    <form action="{{route('admin.roles.store', $role)}}" method="post">
        @csrf
        @include('admin.plantillas.roles')
    </form>
@endsection