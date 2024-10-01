<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnotherDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cantidad_hermanos' => 'required|integer',
            'cantidad_habitantes_hogar' => 'required|integer',
            'medio_transporte' => 'required|in:a pie,omnibus,auto particular,taxi/remis,otro',
            'medio_transporte_otro' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'cantidad_hermanos.required' => 'La cantidad de hermanos es obligatoria.',            
            'cantidad_habitantes_hogar.required' => 'La cantidad de habitantes en el hogar es obligatoria.',            
            'medio_transporte.required' => 'El medio de transporte es obligatorio.',            
        ];
    }
}
