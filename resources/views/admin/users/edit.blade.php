@extends('layouts.app')
@section('title', 'Ajustes de Usuario')

@section('content')
    <p class="h5">{{$user->name}}</p>
    <table class="table">
        <form action="{{route('admin.users.update', $user->id)}}" method="post">
            @csrf
            @method('PUT')
                <thead>
                    <tr>
                        <th>Rol</th>
                        <th>Curso</th>
                        @if($user->hasRole('profesor'))
                            <th>Materias</th>
                        @endif
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @foreach ($roles as $role)
                                <x-label for="role[]">{{$role->name}}
                                <input type="radio" name="role[]" value="{{ $role->id }}" @if($user->roles->contains($role->id)) checked @endif class="rm-1"></x-label>
                                <br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($cursos as $curso)
                            <x-label for="curso[]">
                                {{ $curso->name }}°{{ $curso->division_id }}
                                @if ($user->hasRole('alumno'))
                                    <input type="radio" name="curso[]" value="{{ $curso->id }}"
                                    {{ $user->inscripcion && $user->inscripcion->where('curso_id', $curso->id)->first() ? 'checked' : '' }}
                                    class="rm-1">
                                @else
                                    <input type="checkbox" name="curso[]" value="{{ $curso->id }}"
                                    {{ $user->asignacion && $user->asignacion->contains('curso_id', $curso->id) ? 'checked' : '' }}
                                    class="rm-1">
                                @endif
                            </x-label>
                            <br>
                        @endforeach
                        </td>
                        @if($user->hasRole('profesor'))
                        <td colspan="2">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Aula</strong>
                                    @foreach ($materias->where('tipo', 'aula')->sortBy('name') as $materia)
                                        <x-label for="materia[]">
                                            {{ $materia->name }}
                                            <input type="checkbox" name="materia[]" value="{{ $materia->id }}"
                                            {{ $user->materias->contains($materia->id) ? 'checked' : '' }}
                                            class="rm-1">
                                        </x-label>
                                        <br>
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    <strong>Taller</strong>
                                    @foreach ($materias->where('tipo', 'taller')->sortBy('name') as $materia)
                                        <x-label for="materia[]">
                                            {{ $materia->name }}
                                            <input type="checkbox" name="materia[]" value="{{ $materia->id }}"
                                            {{ $user->materias->contains($materia->id) ? 'checked' : '' }}
                                            class="rm-1">
                                        </x-label>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td><x-button type="submit">Asignar</x-button></td>
                    </tr>
                </tfoot>
        </form>
    </table>
@endsection