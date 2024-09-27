@extends('layouts.app')
@section('title', 'Asistencia')
@section('header')
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Tomar Asistencia
    </h1>
@endsection
@section('content')
<x-validation-errors/>
<table class="table">
    <form id="asistencia-form" action="{{ route('prece.asistencia.store', $curso) }}" method="POST">
        @csrf
        <label for="fecha">Fecha</label>
        <input type="date" name="date" id="inputDate" class="form-control" value="{{ old('date') }}" required>
        <br>
        <select name="turno" id="inputTurno" class="form-control" required>
            <option value="aula" {{ old('turno') == 'aula' ? 'selected' : '' }}>Aula</option>
            <option value="taller" {{ old('turno') == 'taller' ? 'selected' : '' }}>Taller</option>
        </select>
        <br>
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Presente</th>
                    <th>Tarde</th>
                    <th>Ausente</th>
                    <th colspan="4"></th>
                </tr>
            </thead>
            <tbody>    
                @foreach ($alumnos as $alumno)
                    <tr>
                        <input type="hidden" id="inputAlumno" name="asistencias[{{ $alumno->id }}][alumno_id]" value="{{ $alumno->id }}">
                        <td>{{ $alumno->lastname }} {{ $alumno->name }}</td>
                        <td><input type="radio" name="asistencias[{{ $alumno->id }}][estado]" value="presente" {{ old('asistencias.' . $alumno->id . '.estado') == 'presente' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="asistencias[{{ $alumno->id }}][estado]" value="tarde" {{ old('asistencias.' . $alumno->id . '.estado') == 'tarde' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="asistencias[{{ $alumno->id }}][estado]" value="ausente" {{ old('asistencias.' . $alumno->id . '.estado') == 'ausente' ? 'checked' : '' }}></td>
                        <td colspan="4">
                            @error('asistencias.' . $alumno->id . '.estado')
                                <small class="text-danger text-s">Todos los alumnos deben tener su asistencia</small>
                            @enderror
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td><x-button type="submit">Registrar</x-button></td>
            </tfoot>
        </form>
</table>

<script>
document.getElementById('asistencia-form').addEventListener('submit', function(event) {
    const inputDate = document.getElementById('inputDate');
    const inputTurno = document.getElementById('inputTurno');
    const asistencias = @json($asistencias);

    const dateValue = inputDate.value;
    const turnoValue = inputTurno.value;
    let exists = false;

    for (const asistencia of asistencias) {
        if (asistencia.date === dateValue && asistencia.turno === turnoValue) {
            exists = true;
            break;
        }
    }

    if (exists) {
        const overwrite = confirm("Ya existe un registro para esta fecha y turno. ¿Desea sobreescribirlo?");
        if (!overwrite) {
            event.preventDefault();
            return;
        }
    }
});
</script>
@endsection