<div class="card my-5 mx-5">
    <div class="card-body">
        <div class="form-group">
            <x-validation-errors />
            <x-label for="name">Curso</x-label>
            @foreach ($grados as $grado)
                <label>{{ $grado }}</label>
                <input type="radio" name="name" value="{{ $grado }}" 
                       class="mr-4 ml-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                       @if (old('name', $curso->name ?? '') == $grado) checked @endif>
            @endforeach
        </div>
        
        <x-section-border />
        
        <div class="form-group">
            <x-label for="especialidad">Especialidad</x-label>
            <select name="especialidad_id" id="especialidad">
                @foreach ($especialidades as $especialidad)
                    <option value="{{ $especialidad->id }}" 
                            @if(old('especialidad_id', $curso->especialidad_id ?? '') == $especialidad->id) selected @endif>
                        {{ $especialidad->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <x-section-border />
        
        <div class="form-group">
            <x-label for="division">División</x-label>
            @foreach ($divisiones as $division)
                <label for="division-{{ $division->id }}">{{ $division->name }}</label>
                <input type="radio" name="division_id" id="division-{{ $division->id }}" value="{{ $division->id }}" 
                       class="border-gray-300 ml-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-4" 
                       @if (old('division_id', $curso->division_id ?? '') == $division->id) checked @endif>
            @endforeach
        </div>
        
        <x-section-border />
        
        <div class="form-group">
            <x-label for="turno">Turno</x-label>
            @foreach ($turnos as $turno)
                <label for="turno-{{ $turno->id }}">{{ $turno->name }}</label>
                <input type="radio" name="turno_id" id="turno-{{ $turno->id }}" value="{{ $turno->id }}" 
                       class="border-gray-300 ml-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-4" 
                       @if (old('turno_id', $curso->turno_id ?? '') == $turno->id) checked @endif>
            @endforeach
        </div>
        
        <x-button>Guardar</x-button>
    </div>
</div>