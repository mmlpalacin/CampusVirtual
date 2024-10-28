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
        <div class="button-group">
            <button type="button" class="btn bg-white" onclick="showForm('form1')">Datos Académicos</button>
            <button type="button" class="btn bg-white" onclick="showForm('form2')">Datos Personales</button>
            <button type="button" class="btn bg-white" onclick="showForm('form3')">Dirección y Contacto</button>
            <button type="button" class="btn bg-white" onclick="showForm('form4')">Datos Adicionales</button>
            <button type="button" class="btn bg-white" onclick="showForm('form5')">Datos de Salud</button>
            <button type="button" class="btn bg-white" onclick="showForm('padres')">Datos de Padres</button>
        </div>

        <div id="form1" class="form-section" style="display: block;">
            @include('alumno.inscripcion.form')
        </div>
        
        <div id="form2" class="form-section" style="display: none;">
            @include('alumno.inscripcion.form2')
        </div>
        
        <div id="form3" class="form-section" style="display: none;">
            @include('alumno.inscripcion.form3')
        </div>
        
        <div id="form4" class="form-section" style="display: none;">
            @include('alumno.inscripcion.form4')
        </div>
        
        <div id="form5" class="form-section" style="display: none;">
            @include('alumno.inscripcion.form5')
        </div>

        <div id="padres" class="form-section" style="display: none;">
            @include('alumno.inscripcion.padres') <!-- Asegúrate de tener este archivo incluido -->
        </div>
    @else
        Todavía no te inscribiste
    @endif
</div>

<script>
    function showForm(formId) {
        const forms = document.querySelectorAll('.form-section');
        forms.forEach(form => {
            if (form.id === formId) {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    }
</script>
@endsection