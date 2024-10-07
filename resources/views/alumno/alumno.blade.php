    <div class="flex justify-center">
        <ol class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 inline-block">
            <a href="{{route('admin.cursos.show', $curso)}}"><li class="text-center">{{$curso->name}} ° {{$curso->division->name}}, {{$curso->especialidad->name}}</li></a>
        </ol>
    </div>
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
        @elseif(isset($$curso->name))
            <p>No hay monto de cooperadora disponible para el grado {{ $$curso->name }}.</p>
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
    
    <script>
        function show(id){
            document.getElementById(id).style.display = 'inline-flex';
            document.getElementById('btn' + id).style.display = 'none';
        }
    </script>