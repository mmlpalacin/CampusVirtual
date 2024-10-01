<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_documento' => 'required|string|max:20',
            'dni' => 'required|string|max:45',
            'estado_documento' => 'required|boolean',
            'posesion' => 'required|in:posee,en tramite,no posee',
            'genero_id' => 'required|exists:generos,id',
            'nacionalidad' => 'required|string',
            'lugar_nac' => 'required|string',
            'fecha_nac' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',            
            'dni.required' => 'El numero es obligatorio.',            
            'estado_documento.required' => 'El estado del documento es obligatorio.',            
            'posesion.required' => 'El campo posesión es obligatorio.',            
            'genero_id.required' => 'El género es obligatorio.',            
            'nacionalidad.required' => 'La nacionalidad es obligatoria.',            
            'lugar_nac.required' => 'El lugar de nacimiento es obligatorio.',            
            'fecha_nac.required' => 'La fecha de nacimiento es obligatoria.',
        ];
    }
}
