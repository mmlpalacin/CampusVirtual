@extends('layouts.app')
@section('title', 'Materias')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Materia
    </h1>
@endsection
@section('content')
    <form action="{{route('admin.materias.update', $materia)}}" method="post">
        @csrf
        @method('PUT')
        @include('admin.plantillas.materias')
    </form>
@endsection