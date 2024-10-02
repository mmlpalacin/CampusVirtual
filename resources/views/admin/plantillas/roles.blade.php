<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="name" class="h5">Nombre del Rol</label>
            <input type="text" name="name" id="name" value="{{ old('name', $role->name ?? '') }}" class="form-control" placeholder="Ingrese el nombre del Rol">
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <x-section-border/>
        <div class="form-group">
            <label class="h5 block mb-4">Lista de Permisos</label>
            <div  style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                @foreach ($permissions as $permission)
                    <label for="permissions[]">
                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                        @if(is_array(old('permissions', $role->permissions->pluck('id')->toArray())) && in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))) checked @endif class="rm-1">
                        {{$permission->description}}
                    </label>
                @endforeach
            </div>
        </div>
        
        <div class="flex items-center justify-end">
            <x-button>Guardar</x-button>
        </div>
    </div>
</div>