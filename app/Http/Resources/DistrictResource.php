<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
             'codigo' => $this->id,
             'nombre' => $this->name,
             "codProvincia" => $this->province_id,
             "codDepartamento" => $this->department_id
         ];
     }
}
