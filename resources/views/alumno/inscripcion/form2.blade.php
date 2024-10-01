@if ($editable === true)
    @livewire('navigation-menu')
    @vite(['resources/css/form.css', 'resources/css/app.css', 'resources/js/form.js'])
@endif
<x-validation-errors/>
    <form action="{{route('alumno.datos.form2.store', $inscripcion ?? null)}}" method="post" class="mt-4">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label for="tipo_documento">Tipo de Doc.:</label>
                <input type="text" id="tipo_documento" name="tipo_documento" value="{{ old('tipo_documento', $inscripcion->tipo_documento?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            <div class="form-group">    
                <label for="dni">N°:</label>
                <input type="text" id="dni" name="dni" value="{{ old('dni', $inscripcion->dni?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            <div class="form-group">    
                <input type="radio" id="posesion1" name="posesion" value="posee" {{ old('posesion', $inscripcion->posesion ?? '') == 'posee' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>
                <label for="posesion1">Posee</label>
                <input type="radio" id="posesion2" name="posesion" value="en tramite" {{ old('posesion', $inscripcion->posesion ?? '') == 'en tramite' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>
                <label for="posesion2">En Trámite</label>
                <input type="radio" id="posesion3" name="posesion" value="no posee" {{ old('posesion', $inscripcion->posesion ?? '') == 'no posee' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>
                <label for="posesion3">No Posee</label>
            </div>
            <div class="form-group">    
                <label for="estado_documento1">Estado del Documento:</label>
                <input type="radio" id="estado_documento1" name="estado_documento" value="1" {{ old('estado_documento', $inscripcion->estado_documento ?? '') == '1' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>
                <label for="estado_documento1">Bueno</label>
                <input type="radio" id="estado_documento2" name="estado_documento" value="0" {{ old('estado_documento', $inscripcion->estado_documento ?? '') == '0' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>
                <label for="estado_documento2">Malo</label>
            </div>
        </div>
        <div class="form-row">    
            <div class="form-group">
                <label for="genero">Género:</label>
                <select id="genero" name="genero_id" {{ $editable ? '' : 'disabled' }}>
                    @foreach ($generos as $item)
                        <option value="{{$item->id}}" {{ old('genero_id', $inscripcion->genero_id ?? '') == $item->id ? 'selected' : '' }}>{{$item->genero}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">  
                <label for="lugar_nac">Lugar de Nacimiento:</label>
                <input type="text" id="lugar_nac" name="lugar_nac" value="{{ old('lugar_nac', $inscripcion->lugar_nac?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            <div class="form-group">    
                <label for="fecha_nac">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nac" name="fecha_nac" value="{{ old('fecha_nac', $inscripcion->fecha_nac ?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
            <div class="form-group">
                <label for="nacionalidad">Nacionalidad:</label>
                <select id="nacionalidad" name="nacionalidad" {{ $editable ? '' : 'disabled' }}>
                    <option value="argentina" {{ old('nacionalidad', $inscripcion->nacionalidad ?? '') == 'argentina' ? 'selected' : '' }}>Argentina</option>
                    <option value="extranjera" {{ old('nacionalidad', $inscripcion->nacionalidad ?? '') == 'extranjera' ? 'selected' : '' }}>Extranjera</option>
                </select>
            </div>
        </div>
        <x-section-border />
        @if ($editable === true)
        <div class="flex items-center justify-end">
            <x-button>Siguente</x-button>
        </div>
        @endif
    </form>