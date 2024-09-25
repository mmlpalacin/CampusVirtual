@extends('layouts.app')
@section('title', 'cursos')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Crear Curso
    </h1>
@endsection
@section('content')
    <form action="{{route('admin.cursos.store')}}" method="post">
        @csrf
        @include('admin.plantillas.cursos')
    </form>
@endsection