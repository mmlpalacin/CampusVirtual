<div class="mx-2 ">
    <div class="flex justify-between mb-4">
        <button wire:click="previousWeek" class="bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
            Anterior
        </button>
        <div class="text-center text-l font-bold py-2 px-4">
            {{ ucfirst($monthName)}} <br> <p class="mb-1 font-bold card-text small">Faltas/Total de Inasistencias: {{$promedio}}%</p>
        </div>
        <button wire:click="nextWeek" class="bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
            Siguiente
        </button>
    </div>

    <table class="table-auto border-collapse w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Dom</th>
                <th class="px-4 py-2 border">Lun</th>
                <th class="px-4 py-2 border">Mar</th>
                <th class="px-4 py-2 border">Mié</th>
                <th class="px-4 py-2 border">Jue</th>
                <th class="px-4 py-2 border">Vie</th>
                <th class="px-4 py-2 border">Sáb</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calendar as $week)
                <tr>
                    @foreach ($week as $day)
                        <td class="relative px-4 py-2 border text-center">
                            @if ($day)
                                @php
                                    $dayNumber = $day->day;
                                    $asistenciasDelDia = $asistencias->filter(function ($asistencia) use ($day) {
                                        return \Carbon\Carbon::parse($asistencia->date)->isSameDay($day);
                                    });
                                    $colorAula = '';
                                    $colorTaller = '';

                                    foreach ($asistenciasDelDia as $asistencia) {
                                        if ($asistencia) {
                                            if ($asistencia->turno === 'aula') {
                                                $colorAula = $asistencia->estado ?? '';
                                            } elseif ($asistencia->turno === 'taller') {
                                                $colorTaller = $asistencia->estado ?? '';
                                            }
                                        }
                                    }
                                @endphp
                                <div class="flex flex-col h-full justify-between">
                                    <div class="absolute inset-0 {{ $colorAula }} @if($colorAula === $colorTaller) {{ $colorAula }}-darker @endif" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                                    <div class="absolute inset-0 {{ $colorTaller }}" style="clip-path: polygon(100% 100%, 100% 0, 0 100%);"></div>
                                    </div>
                                </div>
                                <div class="relative z-10">
                                    {{ $dayNumber }}
                                </div>
                            @else
                                &nbsp;
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-section-border/>
</div>