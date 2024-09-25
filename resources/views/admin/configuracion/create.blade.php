@extends('layouts.app')
@section('title', 'Configuracion')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Nueva Configuracion
    </h1>
@endsection
@section('content')
    <livewire:configuracion :configuracion="$configuracion ?? null" />
@endsection
<script>
    function validateTime(input) 
    {
        const value = input.value;
        const timePattern = /^(?:[0-9]|[01]\d|2[0-3]):([0-5]\d)(:([0-5]\d))?$/;
        
        if (!timePattern.test(value)) {
            alert("Por favor, ingresa una hora válida en el formato HH:MM. Ejemplo: 13:30");
            input.value = '';
            return;
        }
    }
</script>