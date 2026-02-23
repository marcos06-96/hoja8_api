<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoritoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           
            'nombre'           => $this->nombre,
            'especie'          => $this->especie,
            'raza'             => $this->raza,
            
            
            
            'protectora'       => $this->protectora->nombre_protectora,
                
                
            
        ];
    }
}
