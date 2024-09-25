@extends('layouts.app')
@section('title', 'Horario ' . $curso->name . '°' . $curso->division->name)
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Horario
    </h1>
@endsection
@section('content')
<style>
    .table-days {
        display: flex;
        flex-direction: row;
        overflow-x: auto;
    }

    .table-day {
        margin-right: 1rem;
        border: 1px solid #ddd;
        padding: 1rem;
        flex: 0 0 auto; /* Esto hace que el ancho se ajuste al contenido */
        min-width: 200px; /* Puedes establecer un ancho mínimo si es necesario */
    }
</style>
    @livewire('horarios', ['cursoId' => $curso->id])
@endsection
<script>
    const horaInicioEscuela = "{{ $configuracion->hora_inicio }}";
    const horaFinEscuela = "{{ $configuracion->hora_fin }}";
    function validateTime(input) 
    {
        const value = input.value;
        const timePattern = /^(?:[0-9]|[01]\d|2[0-3]):([0-5]\d)(:([0-5]\d))?$/;
            // ^ --> empieza la cadena.
            // ?:[0-9] --> permite un solo digito del 0 al 9, por si alguien escribe, por ejemplo: 9:00, en lugar de 09:00.
            // ([01]\d --> 0 empieza con 0 o 1 y un digito del uno al diez
            // | 2[0-3]) --> o con un 2 seguido de un numero del 0 al 3.
            // : --> se divide con dos puntos.
            // ([0-5]\d) --> los minutos el primer digito va del 0 al 5 y despues un digito del 1 al 9.
            // $ --> cierra la cadena.
            // / / --> Delimitan el comienzo y el final de la busqueda para validar.
        
        if (!timePattern.test(value)) {
            alert("Por favor, ingresa una hora válida en el formato HH:MM. Ejemplo: 13:30");
            input.value = '';
            return;
        }

        const [hours, minutes] = value.split(':').map(Number); 
        const [minHours, minMinutes] = horaInicioEscuela.split(':').map(Number);
        const [maxHours, maxMinutes] = horaFinEscuela.split(':').map(Number);
        // value.split(':') --> divide el valor en odnde estan los dos puntos (:).
        // .map(Number) --> convierte el texto a valor numerico.s

        if (hours < minHours || (hours === minHours && minutes < minMinutes) ||
        hours > maxHours || (hours === maxHours && minutes > maxMinutes)) {
        alert(`Por favor, ingresa un horario entre ${horaInicioEscuela} y ${horaFinEscuela}.`);
        input.value = '';
        }
    }
</script>