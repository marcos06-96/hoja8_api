<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    
        public function toArray(Request $request): array
{
    return [
        'id'             => $this->id,
        'nombre'         => $this->nombre,
        'especie'        => $this->especie,
        'raza'           => $this->raza,
        'tipo_anuncio'   => $this->tipo_anuncio,
        'estado'         => $this->estado,
        'localidad'      => $this->localidad,
        'adopcion_urgente' => $this->adopcion_urgente,
        'protectora' => $this->whenLoaded('protectora', fn() => [
            
            'nombre' => $this->protectora->nombre_protectora,
        ]),
    ];
}
    }

