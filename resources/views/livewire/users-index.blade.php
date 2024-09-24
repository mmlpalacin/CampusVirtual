<div>
    <div class="card-header">
        <select id="role"  wire:model.live="role" class="form-control" name="user_id">
            <option value="">Todos los Roles</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
        <br>
        <input type="text" wire:model.live="search" class="form-control" placeholder="Ingrese nombre o mail del usuario...">
        <br>
    </div>
    @if ($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th colspan="4"></th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->lastname}}</td>
                        <td>{{$user->email}}</td>
                        <td>@foreach($user->roles as $role)
                            {{ $role->name }}@if(!$loop->last), @endif
                        @endforeach</td>
                        <td width="10px"><a class="btn btn-primary mr-2" href="{{route('admin.users.edit', $user)}}">editar</a></td>
                        <td width="10px">
                            <form action="{{route('admin.users.destroy', $user)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-2">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div class="card-footer">
            {{$users->links()}}
        </div>    
        @else
        <strong>No hay usuarios con ese nombre, mail o rol</strong>
    @endif
</div>