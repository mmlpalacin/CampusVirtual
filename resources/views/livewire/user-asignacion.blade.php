<div class="mx-2 bg-white pb-2">
    <div class="flex">
    <table class="table">
        <thead>
            <tr>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach($roles as $role)
                    <div class="flex mb-2">
                        <input type="radio" id="role_{{ $role->id }}" name="role" value="{{ $role->id }}" wire:model="selectedRole" class="rm-1">
                        <label class="ml-2" for="role_{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
            <tr>
                @if(!$user->hasRole('admin') && !$user->hasRole('cooperadora'))
                    <th>Asignación</th>
                @endif
                @if ($user->hasRole('profesor'))
                    <th>Curso*</th>
                    <th>Materia*</th>
                    <th>Día</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th><button type="button" class="px-1 py-0.5 rounded btn-secondary" wire:click="addHorario">+</button></th>
                @elseif($user->hasRole('preceptor'))
                    <th>Curso</th>
                    <th>Preceptor de Aula</th>
                    <th>Preceptor de Taller</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if ($user->hasRole('profesor'))
                @foreach ($asignaciones as $index => $asignacion)
                    <tr>
                        <td></td>
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
                            <button wire:click="removeHorario({{ $index }})" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            @elseif ($user->hasRole('alumno'))
                <tr>
                    <td></td>
                    <td colspan="5">
                        <select wire:model="selectedCurso">
                            <option value="">Seleccione Curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->name }} ° {{$curso->division->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @elseif($user->hasRole('preceptor'))
                @foreach ($cursos as $curso)
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" id="curso_{{ $curso->id }}" wire:model="preceptor.{{ $curso->id }}.curso_id" value="{{ $curso->id }}">
                            {{ $curso->name }} ° {{ $curso->division->name }}
                        </td>
                        <td>
                            <input type="checkbox" id="aula_{{ $curso->id }}" wire:model="preceptor.{{ $curso->id }}.preceptor_tipo.aula" value="aula" class="ml-4"> Aula
                        </td>
                        <td>
                            <input type="checkbox" id="taller_{{ $curso->id }}" wire:model="preceptor.{{ $curso->id }}.preceptor_tipo.taller" value="taller" class="ml-4"> Taller
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    </div>
    <x-section-border/>
    <x-button wire:click="save">Guardar</x-button>
</div>
