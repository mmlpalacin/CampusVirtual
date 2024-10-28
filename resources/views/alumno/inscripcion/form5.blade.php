@vite(['resources/css/form.css', 'resources/js/app.js', 'resources/css/app.css'])
@livewireScripts
@if ($editable === true)
@livewire('navigation-menu')
@endif
<x-validation-errors/>
    <form action="{{route('alumno.datos.form5.store', $inscripcion ?? null)}}" method="post" class="mt-4">
        @csrf
        <div class="form-row">        
            <div class="form-group">
                <label for="obra_social">Obra Social:</label>
                <input type="text" id="obra_social" name="obra_social" value="{{ old('obra_social', $inscripcion->obra_social?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>            
            <div class="form-group">
                <label for="numero_afiliado">Número de Afiliado:</label>
                <input type="text" id="numero_afiliado" name="numero_afiliado" value="{{ old('numero_afiliado', $inscripcion->numero_afiliado?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
        </div>
        <div class="form-row">        
            <div class="form-group">
                <label>Enfermedad:</label>
                <input type="radio" id="enfermedad1" name="enfermedad" value="1" {{ old('enfermedad', $inscripcion->enfermedad ?? '') == '1' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>Sí
                <input type="radio" id="enfermedad2" name="enfermedad" value="0" {{ old('enfermedad', $inscripcion->enfermedad ?? '') == '0' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>No
            </div>
            
            <div class="form-group">
                <label for="descripcion_enfermedad">Descripción de Enfermedad:</label>
                <input type="text" id="descripcion_enfermedad" name="descripcion_enfermedad" value="{{ old('descripcion_enfermedad', $inscripcion->descripicion_enfermedad?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
        </div>
        <div class="form-row">        
            <div class="form-group">
                <label>Alergia:</label>
                <input type="radio" id="alergia1" name="alergia" value="1" {{ old('alergia', $inscripcion->alergia ?? '') == '1' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>Sí
                <input type="radio" id="alergia2" name="alergia" value="0" {{ old('alergia', $inscripcion->alergia ?? '') == '0' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>No
            </div>
            
            <div class="form-group">
                <label for="descripcion_alergia">Descripción de Alergia:</label>
                <input type="text" id="descripcion_alergia" name="descripcion_alergia" value="{{ old('descripcion_alergia', $inscripcion->descripicion_alergia?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
        </div>
        <div class="form-row">        
            <div class="form-group">
                <label>Tratamiento Permanente:</label>
                <input type="radio" id="tratamiento_permanente1" name="tratamiento_permanente" value="1" {{ old('tratamiento_permanente', $inscripcion->tratamiento_permanente ?? '') == '1' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>Sí
                <input type="radio" id="tratamiento_permanente2" name="tratamiento_permanente" value="0" {{ old('tratamiento_permanente', $inscripcion->tratamiento_permanente ?? '') == '0' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>No
            </div>
            
            <div class="form-group">
                <label for="descripcion_tratamiento">Descripción del Tratamiento:</label>
                <input type="text" id="descripcion_tratamiento" name="descripcion_tratamiento" value="{{ old('descripcion_tratamiento', $inscripcion->descripicion_tratamiento?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
        </div>
        <div class="form-row">        
            <div class="form-group">
                <label>Limitación Física:</label>
                <input type="radio" id="limitacion_fisica1" name="limitacion_fisica" value="1" {{ old('limitacion_fisica', $inscripcion->limitacion_fisica ?? '') == '1' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>Sí
                <input type="radio" id="limitacion_fisica2" name="limitacion_fisica" value="0" {{ old('limitacion_fisica', $inscripcion->limitacion_fisica ?? '') == '0' ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>No
            </div>
            
            <div class="form-group">
                <label for="descripcion_limitacion">Descripción de Limitación Física:</label>
                <input type="text" id="descripcion_limitacion" name="descripcion_limitacion" value="{{ old('descripcion_limitacion', $inscripcion->descripicion_limitacion?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
        </div>
        <div class="form-row">        
            <div class="form-group">
                <label for="otros_problemas_salud">Otros Problemas de Salud:</label>
                <input type="text" id="otros_problemas_salud" name="otros_problemas_salud" value="{{ old('otros_problemas_salud', $inscripcion->otros_problemas_salud?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
        </div>    
        <x-section-border />

        @if ($editable === true)
        <div class="flex items-center justify-between">
            <x-a href="{{ route('alumno.datos.form4', $inscripcion ?? null) }}">Anterior</x-a>
            <div class="flex items-center justify-end">
                <x-button>Siguente</x-button>
            </div>
        </div>
        @endif
    </form>