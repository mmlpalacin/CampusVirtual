@vite(['resources/css/form.css', 'resources/js/app.js', 'resources/css/app.css'])
@livewireScripts
@if ($editable === true)
@livewire('navigation-menu')
@endif
<x-validation-errors/>
<form action="{{route('alumno.datos.form4.store', $inscripcion ?? null)}}" method="post" class="mt-4">
    @csrf
    <div class="form-row">
        <div class="form-group">
            <label for="cantidad_hermanos">Cantidad de Hermanos:</label>
            <input type="number" id="cantidad_hermanos" name="cantidad_hermanos" value="{{ old('cantidad_hermanos', $inscripcion->cantidad_hermanos?? '') }}" {{ $editable ? '' : 'disabled' }}>
        </div>
        
        <div class="form-group">
            <label for="cantidad_habitantes_hogar">Cantidad de Habitantes del Hogar:</label>
            <input type="number" id="cantidad_habitantes_hogar" name="cantidad_habitantes_hogar" value="{{ old('cantidad_habitantes_hogar', $inscripcion->cantidad_habitantes_hogar?? '') }}" {{ $editable ? '' : 'disabled' }}>
        </div>
    </div>
    <div class="form-row">        
        <div class="form-group">
            <label for="medio_transporte">Medio de Transporte:</label>
            <select id="medio_transporte" name="medio_transporte" {{ $editable ? '' : 'disabled' }}>
                <option value="a pie" {{ old('medio_transporte', $inscripcion->medio_transporte ?? '') == 'a pie' ? 'selected' : '' }}>A Pie</option>
                <option value="omnibus" {{ old('medio_transporte', $inscripcion->medio_transporte ?? '') == 'omnibus' ? 'selected' : '' }}>Ómnibus</option>
                <option value="auto particular" {{ old('medio_transporte', $inscripcion->medio_transporte ?? '') == 'auto particular' ? 'selected' : '' }}>Auto Particular</option>
                <option value="taxi/remis" {{ old('medio_transporte', $inscripcion->medio_transporte ?? '') == 'taxi/remis' ? 'selected' : '' }}>Taxi/Remis</option>
                <option value="otro" {{ old('medio_transporte', $inscripcion->medio_transporte ?? '') == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>            
        <div class="form-group">
            <label for="medio_transporte_otro">Medio de Transporte (Otro):</label>
            <input type="text" id="medio_transporte_otro" name="medio_transporte_otro" value="{{ old('medio_transporte_otro', $inscripcion->medio_transporte_otro?? '') }}" {{ $editable ? '' : 'disabled' }}>
        </div>
    </div>
    <x-section-border />
    @if ($editable === true)
    <div class="flex items-center justify-between">
        <x-a href="{{ route('alumno.datos.form3', $inscripcion ?? null) }}">Anterior</x-a>
        <div class="flex items-center justify-end">
            <x-button>Siguente</x-button>
        </div>
    </div>
    @endif
</form>