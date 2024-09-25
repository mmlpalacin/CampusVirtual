@extends('layouts.app')
@section('title', 'cursos')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Curso
    </h1>
@endsection
@section('content')
    <form action="{{route('admin.cursos.update', $curso)}}" method="post">
        @csrf
        @method('put')
        @include('admin.plantillas.cursos')
    </form>
@endsection