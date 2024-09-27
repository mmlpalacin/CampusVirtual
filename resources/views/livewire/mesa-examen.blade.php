<div>
    @foreach($grados as $grado)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Grado</th>
                    <th>Materia</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                    <th>Profesor</th>
                </tr>
            </thead>
            @if(isset($mesas[$grado]))
            @foreach ($mesas[$grado] as $index => $mesa)
                <tbody>
                    <tr>
                        <td>
                            <input type="text" wire:model.defer="mesas.{{$grado}}.{{ $index }}.grado" class="form-control" value="{{ $mesa['grado'] }}" required>
                            @error('grado.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </td>

                        <td>
                            <select wire:model.defer="mesas.{{$grado}}.{{ $index }}.materia_id" class="form-control" required>
                                <option value="">--Seleccione Materia--</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}" {{ $materia->id == $mesa['materia_id'] ? 'selected' : '' }}>
                                        {{ $materia->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('materia_id.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </td>

                        <td>
                            <input type="text" wire:model.defer="mesas.{{$grado}}.{{ $index }}.hora" class="form-control" value="{{ $mesa['hora'] }}" required onchange="validateTime(this)">
                            @error('hora.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </td>

                        <td>
                            <input type="date" wire:model.defer="mesas.{{$grado}}.{{ $index }}.fecha" class="form-control" value="{{ $mesa['fecha'] }}">
                            @error('fecha.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </td>

                        <td>
                            <select wire:model.defer="mesas.{{$grado}}.{{ $index }}.user_id" class="form-control" required>
                                <option value="">--Seleccione Profesor--</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}" {{ $profesor->id == $mesa['user_id'] ? 'selected' : '' }}>
                                        {{ $profesor->lastname }}, {{ $profesor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td>
                            <button wire:click="removeMesa('{{ $grado }}', '{{ $mesa['fecha'] }}')" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            @endforeach
            @endif
        </table>
        <button wire:click="addMesa('{{ $grado }}')" class="btn btn-primary">Agregar Mesa</button>
        <x-section-border/>
    @endforeach

    @if ($mostrarCampo['newgrado'])
        @foreach ($configuracion->grados as $item)
            <button wire:click="addgrado('{{ $item }}')" class="btn btn-primary">{{ $item }}</button>
        @endforeach
    @else
        <button type="button" class="btn btn-primary" wire:click="mostrarCampoNuevo('newgrado')">
            Agregar Mesa para Otro Grado
        </button>
    @endif
    <x-section-border/>

    <x-button wire:click="handleClick" :disabled="$buttonDisabled" class="btn btn-success">Guardar</x-button>

    @if(empty($grados))
        <div class="alert alert-info">
            No hay mesas de examen registradas.
        </div>
    @endif

    <script>
        const horaInicioEscuela = "{{ $configuracion->hora_inicio }}";
        const horaFinEscuela = "{{ $configuracion->hora_fin }}";
        function validateTime(input) 
        {
            const value = input.value;
            const timePattern = /^(?:[0-9]|[01]\d|2[0-3]):([0-5]\d)(:([0-5]\d))?$/;
            
            if (!timePattern.test(value)) {
                alert("Por favor, ingresa una hora válida en el formato HH:MM. Ejemplo: 13:30");
                input.value = '';
                return;
            }
    
            const [hours, minutes] = value.split(':').map(Number); 
            const [minHours, minMinutes] = horaInicioEscuela.split(':').map(Number);
            const [maxHours, maxMinutes] = horaFinEscuela.split(':').map(Number);
    
            if (hours < minHours || (hours === minHours && minutes < minMinutes) ||
            hours > maxHours || (hours === maxHours && minutes > maxMinutes)) {
            alert(`Por favor, ingresa un horario entre ${horaInicioEscuela} y ${horaFinEscuela}.`);
            input.value = '';
            }
        }
    </script>
</div>