<div class="card mx-2">
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <x-validation-errors />

    <form wire:submit.prevent="submit" class="mx-4 my-4">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" wire:model="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" wire:model="direccion" class="form-control">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" wire:model="telefono" class="form-control">
        </div>
        <x-section-border />
        <div class="form-group">
            <label for="ciclo_lectivo">Ciclo Lectivo</label>
            <input type="number" id="ciclo_lectivo" wire:model="ciclo_lectivo" class="form-control" required>
        </div>
        <div class="form-group flex">
            <label for="dias" class="mr-5">Días</label>
            @foreach($diasDeLaSemana as $dia)
                <div class="form-check">
                    <input type="checkbox" id="{{ $dia }}" value="{{ $dia }}" wire:model="dias" class="form-check-input">
                    <label class="form-check-label mr-5" for="{{ $dia }}">{{ $dia }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="turno">Turnos</label>
            <div>
                @foreach ($turnos as $turno)
                    {{ $turno->name }}
                    <button type="button" class="btn btn-danger mr-4 my-1" wire:click.prevent="eliminarItem('turno', '{{ $turno->id }}')">-</button>
                @endforeach
                @if($mostrarCampo['turno'])
                    <input type="text" name="name" wire:model="nuevoTurno" class="mt-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ingrese la nuevo turno">
                    <button type="button" class="btn btn-primary ml-2" wire:click="agregarElemento('turno')">Agregar turno</button>
                @else
                    <br>
                    <x-button class="mt-4" type="button" wire:click="mostrarCampoNuevo('turno')">
                        + Agregar nuevo turno
                    </x-button>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="hora_inicio">Hora Inicio Escuela</label>
            <input type="text" id="hora_inicio" wire:model="hora_inicio" class="form-control" required onchange="validateTime(this)">
        </div>
        <div class="form-group">
            <label for="hora_fin">Hora Fin Escuela</label>
            <input type="text" id="hora_fin" wire:model="hora_fin" class="form-control" required onchange="validateTime(this)">
        </div>
        <x-section-border />
        <div class="form-group flex">
            <label for="jornadas" class="mr-4">Jornadas</label>
            @foreach($jornadasDisponibles as $jornada)
                <div class="form-check">
                    <input type="checkbox" id="{{ $jornada }}" value="{{ $jornada }}" wire:model="jornadas" class="form-check-input">
                    <label class="form-check-label mr-5" for="{{ $jornada }}">{{ $jornada }}</label>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="tipo_evaluacion">Tipo De Evaluación</label>
            <select id="tipo_evaluacion" wire:model="tipo_evaluacion" class="form-control" required>
                <option value="">Seleccione opcion</option>
                <option value="numerica">Numérica</option>
                <option value="letras">Letras</option>
            </select>
        </div>
        <x-section-border />
        <div class="form-group">
            <label for="grados">Grados</label>
            <div>
                @foreach($grados as $id => $grado)
                    <input type="text" wire:model="grados.{{ $id }}" placeholder="Grado">
                    <button type="button" class="btn btn-danger mr-4 my-1" wire:click="eliminarItem('grado', '{{ $id }}')">X</button>
                @endforeach
                @if ($mostrarCampo['grado'])
                    <input type="text" wire:model="nuevoGrado" placeholder="Ingrese el nuevo grado">
                    <button type="button" class="btn btn-primary ml-2" wire:click="agregarElemento('grado')">Agregar Grado</button>
                @else
                <br>
                    <x-button class="mt-4" type="button" wire:click="mostrarCampoNuevo('grado')">
                        + Agregar nuevo grado
                    </x-button>
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="especialidad">Especialidad/Orientacion</label>
            <div>
                @foreach ($especialidades as $especialidad)
                    {{$especialidad->name}}
                    <button type="button" class="btn btn-danger mr-4 my-1" wire:click.prevent="eliminarItem('especialidad', '{{ $especialidad->id }}')">-</button>
                @endforeach
                @if ($mostrarCampo['especialidad'])
                    <input type="text" name="name" wire:model="nuevaEspecialidad" class="mt-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ingrese la nueva especialidad">
                    <button type="button" class="btn btn-primary ml-2" wire:click="agregarElemento('especialidad')">Agregar Especialidad</button>
                @else
                <br>
                    <x-button class="mt-4" type="button" wire:click="mostrarCampoNuevo('especialidad')">
                        + Agregar nueva especialidad
                    </x-button>
                @endif
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="division">División</label>
            <div>
                @foreach ($divisiones as $division)
                    {{ $division->name }}
                    <button type="button" class="btn btn-danger mr-4 my-1" wire:click.prevent="eliminarItem('division', '{{ $division->id }}')">-</button>
                @endforeach
                @if($mostrarCampo['division'])
                    <input type="text" name="name" wire:model="nuevaDivision" class="mt-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ingrese la nueva division">
                    <button type="button" class="btn btn-primary ml-2" wire:click="agregarElemento('division')">Agregar Division</button>
                @else
                <br>
                    <x-button class="mt-4" type="button" wire:click="mostrarCampoNuevo('division')">
                        + Agregar nueva división
                    </x-button>
                @endif
            </div>
        </div>
        <x-section-border />
        <div class="form-group">
            <label for="cooperadora">Cooperadora</label>
            <div>
                @foreach($cooperadora as $id => $item)
                    <div class="input-group mb-3">
                        <input type="number" wire:model="cooperadora.{{ $id }}.montos.0" class="mr-5" placeholder="Monto" required>
        
                        <div class="form-check">
                            @foreach($grados as $grado)
                                <input type="checkbox" wire:model="cooperadora.{{ $id }}.grados" value="{{ $grado }}" class="form-check-input">
                                <label class="form-check-label mr-5">{{ $grado }}</label>
                            @endforeach
                        </div>
        
                        <button type="button" class="btn btn-danger" wire:click="eliminarItem('cooperadora', {{ $id }})">X</button>
                    </div>
                @endforeach
                @if ($mostrarCampo['cooperadora'])
                    <div class="input-group mt-2">
                        <input type="text" wire:model="nuevaCooperadora" placeholder="Ingrese el nuevo monto">
                        <button type="button" class="btn btn-primary ml-2" wire:click="agregarElemento('cooperadora')">Agregar Monto</button>
                    </div>
                @else
                    <x-button type="button" wire:click="mostrarCampoNuevo('cooperadora')">
                        + Agregar nuevo cooperadora
                    </x-button>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
