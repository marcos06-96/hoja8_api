<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalshowResource extends JsonResource
{
    
        public function toArray(Request $request): array
{
    return [
        'id'                     => $this->id,
        'nombre'                 => $this->nombre,
        'especie'                => $this->especie,
        'raza'                   => $this->raza,
        'edad_aproximada'        => $this->edad_aproximada,
        'sexo'                   => $this->sexo,
        'tamanio'                => $this->tamanio,
        'peso'                   => $this->peso,
        'color'                  => $this->color,
        'chip'                   => $this->chip,
        'esterilizado'           => $this->esterilizado,
        'vacunado'               => $this->vacunado,
        'desparasitado'          => $this->desparasitado,
        'bueno_con_ninos'        => $this->bueno_con_ninos,
        'bueno_con_perros'       => $this->bueno_con_perros,
        'bueno_con_gatos'        => $this->bueno_con_gatos,
        'nivel_energia'          => $this->nivel_energia,
        'adopcion_urgente'       => $this->adopcion_urgente,
        'necesidades_especiales' => $this->necesidades_especiales,
        'descripcion'            => $this->descripcion,
        'historia'               => $this->historia,
        'tipo_anuncio'           => $this->tipo_anuncio,
        'estado'                 => $this->estado,
        'localidad'              => $this->localidad,
        'fecha_ingreso'          => $this->fecha_ingreso,
        'protectora' => $this->whenLoaded('protectora', fn() => [
            'id'       => $this->protectora->id,
            'nombre'   => $this->protectora->nombre_protectora,
            'telefono' => $this->protectora->telefono_protectora,
            'email'    => $this->protectora->email_protectora,
        ]),
    ];
}
    }

