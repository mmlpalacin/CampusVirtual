@extends('layouts.app')
@section('title', 'Inscripcion')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Planilla de Inscripcion
    </h1>
    <a href="{{route('alumno.datos.form1', $inscripcion ?? null)}}"><x-button>Inscribirse</x-button></a>
@endsection
@section('content')
<div class="mx-3">
    @if ($inscripcion)
        @include('alumno.inscripcion.form')
        @include('alumno.inscripcion.form2')
        @include('alumno.inscripcion.form3')
        @include('alumno.inscripcion.form4')  
    @else
        Todavia no te inscribiste
    @endif
</div>
@endsection