@if ($editable === true)
    @livewire('navigation-menu')
@endif
@vite(['resources/css/form.css', 'resources/css/app.css', 'resources/js/form.js'])
<x-validation-errors/>
    <form action="{{route('alumno.datos.form1.store', $inscripcion ?? null)}}" method="POST" class="mt-4">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label for="nivel_cursado">Nivel Cursado:</label>
                <select id="nivel_cursado" name="nivel_cursado" {{ $editable ? '' : 'disabled' }}>
                    <option value="ciclo basico" {{ old('nivel_cursado', $inscripcion->nivel_cursado ?? '') == 'ciclo basico' ? 'selected' : '' }}>Ciclo Básico</option>
                    <option value="CESAJ" {{ old('nivel_cursado', $inscripcion->nivel_cursado ?? '') == 'CESAJ' ? 'selected' : '' }}>CESAJ</option>
                    <option value="ciclo superior" {{ old('nivel_cursado', $inscripcion->nivel_cursado ?? '') == 'ciclo superior' ? 'selected' : '' }}>Ciclo Superior</option>
                </select>
                @error('nivel_cursado')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="year">Año</label>
                @foreach ($grados as $item)
                    {{$item}}<input type="radio" name="year" id="year" value="{{$item}}" {{ old('year', $inscripcion->year ?? '') == $item ? 'checked' : '' }} {{ $editable ? '' : 'disabled' }}>
                @endforeach
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="turno">Turno:</label>
                <select id="turno" name="turno" {{ $editable ? '' : 'disabled' }}>
                    <option value="mañana" {{ old('turno', $inscripcion->turno ?? '') == 'mañana' ? 'selected' : '' }}>Mañana</option>
                    <option value="tarde" {{ old('turno', $inscripcion->turno ?? '') == 'tarde' ? 'selected' : '' }}>Tarde</option>
                    <option value="noche" {{ old('turno', $inscripcion->turno ?? '') == 'noche' ? 'selected' : '' }}>Noche</option>
                    <option value="vespertino" {{ old('turno', $inscripcion->turno ?? '') == 'vespertino' ? 'selected' : '' }}>Vespertino</option>
                    <option value="intermedio" {{ old('turno', $inscripcion->turno ?? '') == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                </select>
            </div>
            <div class="form-group">    
                <label for="jornada">Jornada:</label>
                <select id="jornada" name="jornada" {{ $editable ? '' : 'disabled' }}>
                    <option value="simple" {{ old('jornada', $inscripcion->jornada ?? '') == 'simple' ? 'selected' : '' }}>Simple</option>
                    <option value="completa" {{ old('jornada', $inscripcion->jornada ?? '') == 'completa' ? 'selected' : '' }}>Completa</option>
                    <option value="extendida" {{ old('jornada', $inscripcion->jornada ?? '') == 'extendida' ? 'selected' : '' }}>Extendida</option>
                    <option value="doble escolaridad" {{ old('jornada', $inscripcion->jornada ?? '') == 'doble escolaridad' ? 'selected' : '' }}>Doble Escolaridad</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group"> 
                <label for="condicion_alumno">Condición del Alumno:</label>
                <select id="condicion_alumno" name="condicion_alumno" {{ $editable ? '' : 'disabled' }}>
                    <option value="ingresante" {{ old('condicion_alumno', $inscripcion->condicion_alumno ?? '') == 'ingresante' ? 'selected' : '' }}>Ingresante</option>
                    <option value="reinscripto" {{ old('condicion_alumno', $inscripcion->condicion_alumno ?? '') == 'reinscripto' ? 'selected' : '' }}>Reinscripto</option>
                    <option value="promovido" {{ old('condicion_alumno', $inscripcion->condicion_alumno ?? '') == 'promovido' ? 'selected' : '' }}>Promovido</option>
                    <option value="repitente" {{ old('condicion_alumno', $inscripcion->condicion_alumno ?? '') == 'repitente' ? 'selected' : '' }}>Repitente</option>
                </select>
            </div>
            <div class="form-group">    
                <label for="establecimiento_procedencia">Establecimiento de Procedencia:</label>
                <input type="text" id="establecimiento_procedencia" name="establecimiento_procedencia" value="{{ old('establecimiento_procedencia', $inscripcion->establecimiento_procedencia?? '') }}" {{ $editable ? '' : 'disabled' }}>
            </div>
        </div>        
        <x-section-border />
        @if ($editable === true)
        <div class="flex items-center justify-end">
            <x-button>Siguente</x-button>
        </div>
        @endif
    </form>