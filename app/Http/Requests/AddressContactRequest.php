<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'calle' => 'required|string',
            'numero' => 'required|integer',
            'piso' => 'nullable|string',
            'torre' => 'nullable|string',
            'dpto' => 'nullable|string',
            'entre_calles' => 'nullable|string',
            'pais_id' => 'required|exists:pais,id',
            'provincia_id' => 'required|exists:provincias,id',
            'partido_id' => 'required|exists:partidos,id',
            'ciudad_id' => 'required|exists:ciudads,id',
            'telefono' => 'required|string|max:45',
            'telefono_celular' => 'nullable|string|max:45',
        ];
    }

    public function messages(): array
    {
        return [
            'calle.required' => 'La calle es obligatoria.',
            'numero.required' => 'El número es obligatorio.',
            'pais_id.required' => 'El país es obligatorio.',
            'provincia_id.required' => 'La provincia es obligatoria.',
            'partido_id.required' => 'El partido es obligatorio.',
            'ciudad_id.required' => 'La ciudad es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono no puede tener más de 45 caracteres.',
            'telefono_celular.max' => 'El teléfono celular no puede tener más de 45 caracteres.',
        ];
    }
}
