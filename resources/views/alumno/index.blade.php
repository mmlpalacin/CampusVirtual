@extends('layouts.app')
@section('title', 'Inscripcion')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Planilla de Inscripcion
    </h1>
    <form action="{{ route('alumno.imprimir', $inscripcion) }}" method="POST" class="inline">
        @csrf
        <x-button type="submit" class="mr-4">Imprimir Ficha</x-button>
    </form>
    <x-a href="{{route('alumno.datos.form1', $inscripcion ?? null)}}">Inscribirse</x-a>
@endsection
@section('content')
<div class="mx-3">
    @if ($inscripcion)
        @include('alumno.inscripcion.form')
        @include('alumno.inscripcion.form2')
        @include('alumno.inscripcion.form3')
        @include('alumno.inscripcion.form4')  
        @include('alumno.inscripcion.form5')  
    @else
        Todavia no te inscribiste
    @endif
</div>
@endsection