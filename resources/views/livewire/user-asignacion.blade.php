<div class="mx-4">
    <h2 class="h2">{{$user->lastname}}, {{$user->name}}</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Roles</th>
                <th>Asignación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach($roles as $role)
                        <x-label for="role[]">{{ $role->name }}
                            <input type="radio" value="{{ $role->id }}" wire:model="selectedRole" class="rm-1">
                        </x-label>
                        <br>
                    @endforeach
                </td>
                <x-validation-errors/>
                    @if ($user->hasRole('alumno'))
                        <td>
                            <select wire:model="selectedCurso">
                                <option value="">Seleccione Curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->name }} ° {{$curso->division->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    @elseif ($user->hasRole('profesor'))
                        <table>
                            <thead>
                                <tr>
                                    <th>Curso*</th>
                                    <th>Materia*</th>
                                    <th>Día</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asignaciones as $index => $asignacion)
                                    <tr>
                                        <td>
                                            <select wire:model="asignaciones.{{ $index }}.curso_id">
                                                <option value="">Seleccionar Curso</option>
                                                @foreach ($cursos as $curso)
                                                    <option value="{{ $curso->id }}">{{ $curso->name }} ° {{$curso->division->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select wire:model="asignaciones.{{ $index }}.materia_id">
                                                <option value="">Seleccionar Materia</option>
                                                @foreach ($materias as $materia)
                                                    <option value="{{ $materia->id }}">{{ $materia->name }}, {{$materia->tipo}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select wire:model="asignaciones.{{ $index }}.dia">
                                                <option value="">Seleccionar Dia</option>
                                                @foreach ($dias as $dia)
                                                    <option value="{{ $dia }}">{{ $dia }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" wire:model="asignaciones.{{ $index }}.hora_inicio" onchange="validateTime(this)"/>
                                        </td>
                                        <td>
                                            <input type="text" wire:model="asignaciones.{{ $index }}.hora_fin" onchange="validateTime(this)"/>
                                        </td>
                                        <td>
                                            <button wire:click="removeHorario({{ $index }})">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-section-border/>
                        <x-button wire:click="addHorario">Agregar Horario</x-button>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <x-button wire:click="save">Guardar</x-button>
</div>