<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];
        foreach(['padre', 'madre'] as $tipo){
            $rules["{$tipo}.apellido"] = 'required|string|max:255';
            $rules["{$tipo}.nombre"] = 'required|string|max:255';
            $rules["{$tipo}.nacionalidad"] = 'required|string|max:255';
            $rules["{$tipo}.asistio_establecimiento_educacional"] = 'required|boolean';
            $rules["{$tipo}.nivel_mas_alto"] = 'required|in:primario,secundario,terciario,universitario';
            $rules["{$tipo}.completo_nivel"] = 'required|boolean';
            $rules["{$tipo}.vive"] = 'required|boolean';
        
            if ($this->input("{$tipo}.vive") === true) {
                $rules["{$tipo}.tipo_documento"] = 'required|string|max:255';
                $rules["{$tipo}.numero_documento"] = 'required|string|max:255';
                $rules["{$tipo}.posesion"] = 'required|in:en tramite,no tiene documento';
                $rules["{$tipo}.domicilio_calle"] = 'required|string|max:255';
                $rules["{$tipo}.domicilio_numero"] = 'required|string|max:10';
                $rules["{$tipo}.domicilio_piso"] = 'nullable|string|max:10';
                $rules["{$tipo}.domicilio_torre"] = 'nullable|string|max:10';
                $rules["{$tipo}.domicilio_dpto"] = 'nullable|string|max:10';
                $rules["{$tipo}.pais_id"] = 'required|exists:pais,id';
                $rules["{$tipo}.provincia_id"] = 'required|exists:provincias,id';
                $rules["{$tipo}.partido_id"] = 'required|exists:partidos,id';
                $rules["{$tipo}.ciudad_id"] = 'required|exists:ciudads,id';
                $rules["{$tipo}.telefono"] = 'nullable|string|max:20';
                $rules["{$tipo}.celular"] = 'nullable|string|max:20';
                $rules["{$tipo}.email"] = 'nullable|email|max:255';
                $rules["{$tipo}.jefe_hogar"] = 'nullable|boolean';
                $rules["{$tipo}.profesion"] = 'nullable|string|max:255';
                $rules["{$tipo}.condicion_actividad"] = 'nullable|in:solo_trabaja,trabaja_y_estudia,busca_trabajo_y_estudia,solo_busca_trabajo,trabaja_y_recibe_jubilacion,busca_trabajo_y_recibe_jubilacion,jubilado_pensionado,solo_estudia,otro';
            }
        }
        
        if ($this->input('padre.vive') === false && $this->input('madre.vive') === false) {
            $rules['tutor.apellido'] = 'required|string|max:255';
            $rules['tutor.nombre'] = 'required|string|max:255';
            $rules['tutor.nacionalidad'] = 'required|string|max:255';
            $rules['tutor.asistio_establecimiento_educacional'] = 'required|boolean';
            $rules['tutor.nivel_mas_alto'] = 'required|in:primario,secundario,terciario,universitario';
            $rules['tutor.completo_nivel'] = 'required|boolean';
            $rules['tutor.tipo_documento'] = 'required|string|max:255';
            $rules['tutor.numero_documento'] = 'required|string|max:255';
            $rules['tutor.posesion'] = 'required|in:en tramite,no tiene documento';
            $rules['tutor.domicilio_calle'] = 'required|string|max:255';
            $rules['tutor.domicilio_numero'] = 'required|string|max:10';
            $rules['tutor.domicilio_piso'] = 'nullable|string|max:10';
            $rules['tutor.domicilio_torre'] = 'nullable|string|max:10';
            $rules['tutor.domicilio_dpto'] = 'nullable|string|max:10';
            $rules['tutor.pais_id'] = 'required|exists:pais,id';
            $rules['tutor.provincia_id'] = 'required|exists:provincias,id';
            $rules['tutor.partido_id'] = 'required|exists:partidos,id';
            $rules['tutor.ciudad_id'] = 'required|exists:ciudads,id';
            $rules['tutor.telefono'] = 'nullable|string|max:20';
            $rules['tutor.celular'] = 'nullable|string|max:20';
            $rules['tutor.email'] = 'nullable|email|max:255';
            $rules['tutor.jefe_hogar'] = 'nullable|boolean';
            $rules['tutor.profesion'] = 'nullable|string|max:255';
            $rules['tutor.condicion_actividad'] = 'nullable|in:solo_trabaja,trabaja_y_estudia,busca_trabajo_y_estudia,solo_busca_trabajo,trabaja_y_recibe_jubilacion,busca_trabajo_y_recibe_jubilacion,jubilado_pensionado,solo_estudia,otro';
        }

        return $rules;
    }
}