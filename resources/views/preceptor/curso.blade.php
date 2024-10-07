@extends('layouts.app')
@section('title', $curso->name . "°" . $curso->division->name)
@section('header')
    @can('prece.asistencia.create')
        <x-a href="{{route('prece.asistencia.index', $curso)}}">Ver Asistencia</x-a>
    @endcan
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        {{$curso->name}} ° {{$curso->division->name}}
    </h1>
    @can('profe.boletin')
        <x-a href="{{route('profe.notas.edit', $curso->id)}}">Lista de Notas</x-a>
    @endcan
    @can('prece.asistencia.create')
        <x-a href="{{route('prece.asistencia.create', $curso)}}">Tomar Asistencia</x-a>
    @endcan
@endsection
@section('content')
@vite(['resources/css/imagen.css', 'resources/js/imagen.js'])
<div class="card">
    <div class="card-body">
        <h3 class="h3 mb-3">Alumnos</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Apellido y Nombre</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->lastname }}, {{ $alumno->name }}<input type="hidden" name="id[]" value="{{ $alumno->id }}"></td>
                    @can('profe.boletin')
                        <td width="10px"><x-a href="{{ route('alumno.boletin', ['user' => $alumno])}}">Boletin</x-a></td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <x-section-border />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h3">Horario</h3>
                @can('admin.horario.edit')
                    <x-a href="{{ route('horario', $curso) }}">Horario</x-a>
                @endcan
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Hora</th>
                        @foreach ($dias as $dia)
                            <th>{{ $dia }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horas as $hora)
                        <tr>
                            <td>{{ $hora->hora_inicio }} <br> {{ $hora->hora_fin }}</td>
                            @foreach ($dias as $dia)
                                <td>
                                    @php
                                        $horaDia = $horarios->get($dia, collect())->firstWhere('hora_inicio', $hora->hora_inicio);
                                    @endphp
                                    @if ($horaDia)
                                        {{ $horaDia->materia->name }}<br>
                                        @if ($horaDia->profesor)
                                            {{ $horaDia->profesor->lastname }}, {{ $horaDia->profesor->name }}
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-section-border />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($curso->anuncio as $index => $anuncio) 
                <div class="bg-white overflow-hidden pb-3 shadow-xl mt-4 sm:rounded-lg">
                    <p class="mb-1 card-text small text-muted mt-4 ml-4 text-left">{{$anuncio->published}}</p>
                    @if ($anuncio->curso)
                        <p class="mb-1 card-text small text-muted mt-4 ml-4 text-left">{{$anuncio->curso->name}} ° {{$anuncio->curso->division->name}}</p>
                    @endif
                    <div class="flex flex-col items-center"> 
                        <h3 class="h4 font-weight-bold">{{$anuncio->title}}</h3>
                        <p class="card-text ml-4">{!! $anuncio->body !!}</p>  
                        @if($anuncio->image->count())
                            <div class="slider" id="slider-{{$index}}">
                                <input type="button" class="prev" value="←" onclick="cambiarManual('IZQ', {{$index}})">
                                @foreach($anuncio->image->shuffle() as $key => $image)
                                    <img class="slider-item" src="{{ Storage::url($image->url) }}" alt="{{$anuncio->title}}: Imagen {{$key}}">
                                @endforeach
                                <input type="button" class="next" value="→" onclick="cambiarManual('DER', {{$index}})">
                            </div>                    
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection