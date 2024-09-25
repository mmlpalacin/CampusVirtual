<div>
    @if (session()->has('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif
    <div class="table-days">
        @foreach ($dias as $dia)
        <div class="table-day">
            <h1 class="h3">{{ $dia }}</h1>
            <table class="table">
            <tbody>
                @if (isset($horarioData[$dia]))
                    @foreach ($horarioData[$dia] as $key => $data)
                        <tr>
                            <td>
                                <!-- hora de inicio y fin -->
                                <input type="text" placeholder="Horas:Minutos" wire:model.defer="horarioData.{{ $dia }}.{{ $key }}.hora_inicio" class="form-control" onchange="validateTime(this)">
                                <input type="text" placeholder="Horas:Minutos" wire:model.defer="horarioData.{{ $dia }}.{{ $key }}.hora_fin" class="form-control mt-1" onchange="validateTime(this)">
                            </td>
                            <td>
                                <!-- Selección de materia -->
                                <select wire:model.defer="horarioData.{{ $dia }}.{{ $key }}.materia_id" class="form-control">
                                    <option value="">Seleccione materia</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->id }}" {{ isset($data['materia_id']) && $data['materia_id'] == $materia->id ? 'selected' : '' }}>
                                            {{ $materia->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Selección de profesor -->
                                <select wire:model.defer="horarioData.{{ $dia }}.{{ $key }}.profesor_id" class="form-control mt-1">
                                    <option value="">Seleccione profesor</option>
                                    @foreach ($profesores as $profesor)
                                        <option value="{{ $profesor->id }}" {{ isset($data['profesor_id']) && $data['profesor_id'] == $profesor->id ? 'selected' : '' }}>
                                            {{ $profesor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button wire:click="removeHorario('{{ $dia }}', '{{ $data['hora_inicio'] }}')" class="btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td colspan="3">
                        <button wire:click="addHorario('{{ $dia }}')" class="btn btn-primary">Agregar Horario</button>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        @endforeach
        </div>

        <x-button wire:click="handleClick" :disabled="$buttonDisabled" class="btn btn-success">Guardar Horarios</x-button>
</div>
