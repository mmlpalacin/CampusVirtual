@extends('layouts.app')
@section('title', 'Perfil')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Perfil
    </h1>
@endsection
@section('content')
    <div class="flex flex-col items-center">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <img class="h-20 w-20 rounded-full object-cover mb-2 mt-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        @else
            {{ Auth::user()->name }}
            <svg class="h-20 w-20 rounded-full object-cover mb-2 mt-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        @endif
        <h2 class="text-lg font-bold mb-1">{{ Auth::user()->lastname }}, {{ Auth::user()->name }}</h2>
        <h3 class="text-sm text-gray-600">{{ Auth::user()->email }}</h3>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
            </div>
        </div>
    </div>
    @if($role === 'alumno')
    <x-section-border />
    <div class="text-center items-center">
        @if (isset($montoCooperadora) && $montoCooperadora - $cooperadora->pagado > 0)
            <p class="text-center text-l font-bold">Cooperadora pagada: {{$cooperadora->pagado}}</p>
            @if ($cooperadora->monto_pendiente > 0)
                <p class="text-center text-l font-bold">Pendiente de aprobacion: {{$cooperadora->monto_pendiente}}</p>
            @endif

            @if ($cooperadora->estado == 'desaprobado')
                <p class="text-center text-l font-bold">Pago Desaprobado: {{$cooperadora->observacion}}</p>
            @endif
            <p class="text-center text-l font-bold">Cooperadora restante: {{$montoCooperadora - $cooperadora->pagado}}</p>
            @if(Auth::user()->inscripcion->curso)
            <p>Monto total para {{ Auth::user()->inscripcion->curso->name }}: {{ $montoCooperadora }}</p>
            @endif
            <x-button class="mt-2" onclick="show('formContainer')" id="btnformContainer">Pagar Cooperadora</x-button>
            <section class="align-items-center" id="formContainer" style="display: none;">
                @livewire('cooperadora', ['cooperadora' => $cooperadora])            
            </section>
        @elseif(isset($montoCooperadora) && $montoCooperadora - $cooperadora->pagado = 0)
            <p style="background-color: rgb(182, 245, 182)">Pagaste el total de la cooperadora</p>
        @elseif(isset($gradoAlumno))
            <p>No hay monto de cooperadora disponible para el grado {{ $gradoAlumno }}.</p>
        @else
            <p>Sin datos de cooperadora</p>
        @endif
        <x-section-border/>

        <x-button type="button" id="btncomprobantes" onclick="show('comprobantes')">Comprobantes</x-button>
        <div id="comprobantes" style="display: none;flex-wrap: wrap;gap: 10px;justify-content: center;">
           @if(isset($cooperadora) && $cooperadora->comprobantes)
                @foreach ($cooperadora->comprobantes as $item)
                <a href="{{ asset('storage/comprobantes/' . basename($item->url)) }}" target="_blank">
                    <img src="{{ asset('storage/comprobantes/' . basename($item->url)) }}" style="width: 100px; height: auto; border-radius: 8px;"">
                </a>
                @endforeach
            @else
                <p class="text-center text-l font-bold">No tienes comprobantes aun.</p>
            @endif
        </div>
    </div>

    <x-section-border/>
    @livewire('calendario')
    @endif

    <script>
        function show(id){
            document.getElementById(id).style.display = 'inline-flex';
            document.getElementById('btn' + id).style.display = 'none';
        }
    </script>
@endsection