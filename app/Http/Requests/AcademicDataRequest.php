<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AcademicDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nivel_cursado' => 'required|in:ciclo basico,CESAJ,ciclo superior',
            'grado' => 'required|string',
            'turno' => 'required|in:mañana,tarde,noche,vespertino,intermedio',
            'jornada' => 'required|in:simple,completa,extendida,doble escolaridad',
            'condicion_alumno' => 'nullable|in:ingresante,reinscripto,promovido,repitente',
            'establecimiento_procedencia' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nivel_cursado.required' => 'El nivel es obligatorio.',
            'grado.required' => 'El año es obligatorio.',
            'turno.required' => 'El turno es obligatorio.',
            'jornada.required' => 'La jornada es obligatoria.',
        ];
    }
}
