<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataPersonalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */ 
    public function toArray($request)
    {
        return [
            'nombre_completo' => $this->nombre_completo,
            // 'direccion' => $this->data["direccion"],
            // 'success'=> $this->data['success'],
            // 'numero'=> $this->data['numero'],
            // Otros atributos según tus necesidades
        ];
    }
   
}
