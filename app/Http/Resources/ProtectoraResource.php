<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProtectoraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
        'id'          => $this->id,
        'nombre'      => $this->nombre_protectora,
        'email'       => $this->email_protectora,
        'telefono'    => $this->telefono_protectora,
        'descripcion' => $this->descripcion,
        'web'         => $this->web,
        'estado'      => $this->estado,
        'animales'    => $this->whenCounted('animales_count'),
        'adopciones'  => $this->whenCounted('adopciones'),
    ];
    }
}
