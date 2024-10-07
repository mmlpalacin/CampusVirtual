<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="name">Nombre de la materia</label>
            <input type="text" name="name" value="{{ old('name', $materia->name ?? '') }}" class="form-control" placeholder="Ingrese el nombre de la materia">
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <x-label for="turno">Tipo</x-label>
            Aula<input type="radio" id="tipo1" name="tipo" value="aula" @if (old('tipo', $materia->tipo ?? '') == 'aula') checked @endif class="border-gray-300 ml-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-4">
            Taller<input type="radio" id="tipo2" name="tipo" value="taller" @if (old('tipo', $materia->tipo ?? '') == 'taller') checked @endif class="border-gray-300 ml-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-4">
        </div>

        <div class="flex items-center justify-end">
            <x-button type="submit">Guardar</x-button>
        </div>
    </div>
</div>