<div>
    <table>
        <thead>
            <tr>
                <th>Alumnos</th>
                @for ($bimestre = 1; $bimestre <= 4; $bimestre++)
                    <th>
                        @if (isset($mostrarCampo['nota']) && isset($mostrarCampo['nota'][$bimestre]) && $mostrarCampo['nota'][$bimestre])
                            <div class="mt-2">
                                <input type="text" wire:model="nuevaNota" placeholder="Nota de:">
                                <button type="button" class="btn btn-primary ml-2" wire:click="agregarNota({{ $bimestre }})">Agregar Nota</button>
                            </div>
                        @else
                        Bimestre {{ $bimestre }}<button wire:click="mostrarCampoNuevo('nota', {{ $bimestre }})" class="btn btn-secondary">+</button>
                        @endif
                    </th>
                @endfor
                <th colspan="6"></th>
            </tr>
            <tr>
                <th></th>
                @for ($bimestre = 1; $bimestre <= 4; $bimestre++)
                    <th>
                        @if(isset($tiposNotas[$bimestre]))
                        <div class="flex">
                            @foreach (array_unique($tiposNotas[$bimestre]) as $item)
                                <p class="mx-2 text-center" style="padding: 1.5px">{{ ucfirst($item) }}</p>
                            @endforeach
                        </div>
                        @endif
                    </th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->lastname }}, {{ $alumno->name }}</td>
                    @for ($bimestre = 1; $bimestre <= 4; $bimestre++)
                        <td>
                            @if (isset($notasData[$alumno->id][$bimestre]))
                                <div class="flex flex-row items-center">
                                    @foreach($notasData[$alumno->id][$bimestre] as $notaKey => $notaValue)
                                        <input type="text" wire:model.defer="notasData.{{ $alumno->id }}.{{ $bimestre }}.{{ $notaKey }}.nota" placeholder="Nota" class="mx-1 text-center" style="width: 30px; min-width: 30px; padding: 2px; border: 1px solid rgb(204, 204, 204); box-sizing: content-box;">
                                    @endforeach
                                </div>
                            @else
                                <p class="text-center">-</p>
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-section-border/>
    <x-button wire:click="save" class="btn btn-primary">Guardar Notas</x-button>

    @if (session()->has('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif
</div>
