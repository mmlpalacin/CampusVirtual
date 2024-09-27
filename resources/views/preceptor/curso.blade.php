@extends('layouts.app')
@section('title', $curso->name . "°" . $curso->division->name)
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        {{$curso->name}} ° {{$curso->division->name}}
    </h1>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>alumnos</th>
                    @can('prece.asistencia.create')
                        <th width="10px"><a href="{{route('prece.asistencia.create', $curso)}}"><x-button>Tomar Asistencia</x-button></a></th>
                        <th width="10px"><a href="{{route('prece.asistencia.index', $curso)}}"><x-button>Ver Asistencia</x-button></a></th>
                    @endcan   
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->lastname }}, {{ $alumno->name }}<input type="hidden" name="id[]" value="{{ $alumno->id }}"></td>
                    @can('profe.boletin')
                        <td width="10px"><a href=""><x-button>Boletin</x-button></a></td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <x-section-border />
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Horario</h1>
            @can('admin.horario.edit')
                <a href="{{ route('horario', $curso) }}"><x-button>Horario</x-button></a>
            @endcan
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Hora</th>
                    @foreach ($dias as $dia)
                        <th>{{ $dia }}</th>
                    @endforeach
                    <th colspan="7"></th>
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
    <x-section-border />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($curso->anuncio as $anuncio) 
                <div class="bg-white overflow-hidden pb-3 shadow-xl mt-4 sm:rounded-lg">

                    <p class="mb-1 card-text small text-muted mt-4 ml-4 text-left">{{$anuncio->published}}</p>
                    @if ($anuncio->curso)
                        <p class="mb-1 card-text small text-muted mt-4 ml-4 text-left">{{$anuncio->curso->name}} ° {{$anuncio->curso->division->name}}</p>
                    @endif
                    <div class=" flex flex-col items-center"> 
                        <h3 class="h4 font-weight-bold">{{$anuncio->title}}</h3>
                        <p class="card-text ml-4">{!!$anuncio->body!!}</p>  
                        @if($anuncio->image->count())
                            <div class="swiper-container swiper-container-{{$anuncio->id}} mb-2 mt-2">
                                <div class="swiper-wrapper">
                                    @foreach($anuncio->image->shuffle() as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ Storage::url($image->url) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection