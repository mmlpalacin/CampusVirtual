@extends('layouts.app')
@section('title', 'Perfil')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Planilla de Notas
    </h1>
@endsection
@section('content')
<div>
    @if ($materias->count() > 1)
        <div class="mb-4">
            <label for="materia">Seleccionar Materia:</label>
            <select id="materia" onchange="cambiarMateria(this.value)">
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                @endforeach
            </select>
        </div>
    @endif

    @livewire('notas', ['curso' => $curso, 'materiaId' =>  $materias->first()->id])
    
    <script>
        function adjustWidth(input) {
            const minWidth = 20;
            const newWidth = Math.max(input.value.length * 6, minWidth) + 'px';
            input.style.width = newWidth;
        }
        function cambiarMateria(materiaId) {
            Livewire.emit('cambiarMateria', materiaId);
        }
    </script>
@endsection