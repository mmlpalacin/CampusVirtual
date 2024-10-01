<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'obra_social' => 'required|string',
            'numero_afiliado' => 'required|string',
            'enfermedad' => 'required|boolean',
            'descripcion_enfermedad' => 'nullable|string',
            'alergia' => 'required|boolean',
            'descripcion_alergia' => 'nullable|string',
            'tratamiento_permanente' => 'required|boolean',
            'descripcion_tratamiento' => 'nullable|string',
            'limitacion_fisica' => 'required|boolean',
            'descripcion_limitacion' => 'nullable|string',
            'otros_problemas_salud' => 'nullable|string',
        ];
    }
   
    public function messages(): array
    {
        return [
            'obra_social.required' => 'La obra social es obligatoria.',
            'numero_afiliado.required' => 'El número de afiliado es obligatorio.',
            'enfermedad.required' => 'Debe indicar si tiene alguna enfermedad.',
            'enfermedad.boolean' => 'El campo enfermedad debe ser verdadero o falso.',
            'descripcion_enfermedad.string' => 'La descripción de la enfermedad debe ser una cadena de texto.',
            'alergia.required' => 'Debe indicar si tiene alguna alergia.',
            'alergia.boolean' => 'El campo alergia debe ser verdadero o falso.',
            'descripcion_alergia.string' => 'La descripción de la alergia debe ser una cadena de texto.',
            'tratamiento_permanente.required' => 'Debe indicar si está bajo tratamiento permanente.',
            'tratamiento_permanente.boolean' => 'El campo tratamiento permanente debe ser verdadero o falso.',
            'descripcion_tratamiento.string' => 'La descripción del tratamiento debe ser una cadena de texto.',
            'limitacion_fisica.required' => 'Debe indicar si tiene alguna limitación física.',
            'limitacion_fisica.boolean' => 'El campo limitación física debe ser verdadero o falso.',
            'descripcion_limitacion.string' => 'La descripción de la limitación física debe ser una cadena de texto.',
            'otros_problemas_salud.string' => 'El campo otros problemas de salud debe ser una cadena de texto.',
        ];
    }
}
