@extends('layouts.app')
@section('title', 'Materias')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Crear Materia
    </h1>
@endsection
@section('content')
    <form action="{{route('admin.materias.store')}}" method="post">
        @csrf
        @include('admin.plantillas.materias')
    </form>
@endsection