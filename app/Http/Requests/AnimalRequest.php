<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('POST') || $this->isMethod('PUT')) {
            $required = 'required';
        } else {
            $required = 'sometimes'; // PATCH
        }

        return [
            'nombre'                 => "$required|string|max:100",
            'especie'                => "$required|in:perro,gato,conejo,hurón",
            'sexo'                   => "$required|in:macho,hembra",
            'tipo_anuncio'           => "$required|in:adopcion,acogida,ambos",
            'estado'                 => "$required|in:disponible,reservado,adoptado",
            'raza'                   => 'nullable|string|max:100',
            'edad_aproximada'        => 'nullable|numeric',
            'tamanio'                => 'nullable|in:pequeño,mediano,grande',
            'peso'                   => 'nullable|numeric',
            'color'                  => 'nullable|string|max:100',
            'chip'                   => 'boolean',
            'esterilizado'           => 'boolean',
            'vacunado'               => 'boolean',
            'desparasitado'          => 'boolean',
            'bueno_con_ninos'        => 'boolean',
            'bueno_con_perros'       => 'boolean',
            'bueno_con_gatos'        => 'boolean',
            'nivel_energia'          => 'nullable|in:bajo,medio,alto',
            'adopcion_urgente'       => 'in:si,no',
            'necesidades_especiales' => 'nullable|string',
            'descripcion'            => 'nullable|string',
            'historia'               => 'nullable|string',
            'localidad'              => 'nullable|string|max:100',
            'fecha_ingreso'          => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'        => 'El nombre es obligatorio',
            'especie.required'       => 'La especie es obligatoria',
            'especie.in'             => 'La especie debe ser perro, gato, conejo o hurón',
            'sexo.required'          => 'El sexo es obligatorio',
            'sexo.in'                => 'El sexo debe ser macho o hembra',
            'tipo_anuncio.required'  => 'El tipo de anuncio es obligatorio',
            'tipo_anuncio.in'        => 'El tipo de anuncio debe ser adopcion, acogida o ambos',
            'estado.required'        => 'El estado es obligatorio',
            'estado.in'              => 'El estado debe ser disponible, reservado o adoptado',
            'tamanio.in'             => 'El tamaño debe ser pequeño, mediano o grande',
            'nivel_energia.in'       => 'El nivel de energía debe ser bajo, medio o alto',
            'peso.numeric'           => 'El peso debe ser un número',
            'fecha_ingreso.date'     => 'La fecha de ingreso no es válida',
        ];
    }
}