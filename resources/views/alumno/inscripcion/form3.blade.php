@vite(['resources/css/form.css', 'resources/css/app.css', 'resources/js/form.js', 'resources/js/app.js'])
@livewireScripts
@if ($editable === true)
    @livewire('navigation-menu')
@endif
    <form action="{{route('alumno.datos.form3.store', $inscripcion ?? null)}}" method="post" class="mt-4">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" id="calle" name="calle" value="{{ old('calle', $inscripcion->calle ?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            @error('calle')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="form-group">    
                <label for="numero">N°:</label>
                <input type="text" id="numero" name="numero" value="{{ old('numero', $inscripcion->numero ?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            @error('numero')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="piso">Piso:</label>
                <input type="text" id="piso" name="piso" value="{{ old('piso', $inscripcion->piso ?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            @error('piso')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="form-group">     
                <label for="torre">Torre:</label>
                <input type="text" id="torre" name="torre" value="{{ old('torre', $inscripcion->torre?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            @error('torre')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="form-group"> 
                <label for="dpto">Dpto:</label>
                <input type="text" id="dpto" name="dpto" value="{{ old('dpto', $inscripcion->dpto ?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            @error('dpto')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="form-group">     
                <label for="entre_calles">Entre Calles:</label>
                <input type="text" id="entre_calles" name="entre_calles" value="{{ old('entre_calles', $inscripcion->entre_calles?? '') }}" {{ $editable ? '' : 'disabled' }}>            
            </div>
            @error('entre_calles')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-row" id="alumnoForm">
            <div class="form-group">
                <label for="pais">País:</label>
                <select id="pais" name="pais_id" {{ $editable ? '' : 'disabled' }}>
                    <option value="">Seleccione un país</option>
                    @foreach($paises as $pais)
                        <option value="{{ $pais->id }}" {{ old('pais_id', $inscripcion->pais_id ?? '') == $pais->id ? 'selected' : '' }}>{{ $pais->pais }}</option>
                    @endforeach
                </select>
                @error('pais_id')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
                
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <select id="provincia" name="provincia_id" {{ old('provincia_id', $inscripcion->provincia_id?? '') ? '' : 'disabled' }}  {{ $editable ? '' : 'disabled' }}>
                    <option value="">Seleccione una provincia</option>
                    @foreach($provincias as $provincia)
                        <option value="{{ $provincia->id }}" {{ old('provincia_id', $inscripcion->provincia_id ?? '') == $provincia->id ? 'selected' : '' }}>{{ $provincia->provincia }}</option>
                    @endforeach
                </select>
                @error('provincia_id')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
                
            <div class="form-group">
                <label for="partido">Partido:</label>
                <select id="partido" name="partido_id" {{ old('partido_id', $inscripcion->partido_id?? '') ? '' : 'disabled' }}  {{ $editable ? '' : 'disabled' }}>
                        <option value="">Seleccione un partido</option>
                        @foreach($partidos as $partido)
                            <option value="{{ $partido->id }}" {{ old('partido_id', $inscripcion->partido_id ?? '') == $partido->id ? 'selected' : '' }}>{{ $partido->partido }}</option>
                        @endforeach
                </select>
                @error('partido_id')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
                
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <select id="ciudad" name="ciudad_id" {{ old('ciudad_id', $inscripcion->ciudad_id?? '') ? '' : 'disabled' }}  {{ $editable ? '' : 'disabled' }}>
                    <option value="">Seleccione una ciudad</option>
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" {{ old('ciudad_id', $inscripcion->ciudad_id ?? '') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->ciudad }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">    
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $inscripcion->telefono?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            @error('telefono')
                <small class="text-danger">{{$message}}</small>
            @enderror         
            <div class="form-group">
                <label for="telefono_celular">Teléfono Celular:</label>
                <input type="text" id="telefono_celular" name="telefono_celular" value="{{ old('telefono_celular', $inscripcion->telefono_celular?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            @error('telefono_celular')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <x-section-border />
        @if ($editable === true)
        <div class="flex items-center justify-between">
            <x-a href="{{ route('alumno.datos.form2', $inscripcion ?? null) }}">Anterior</x-a>
            <div class="flex items-center justify-end">
                <x-button>Siguente</x-button>
            </div>
        </div>
        @endif
    </form>
<x-section-border />