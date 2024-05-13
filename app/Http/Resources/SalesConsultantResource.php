<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesConsultantResource extends JsonResource
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
            'id' => $this->id,
            'tipoDocumento' => $this->person->document_type,
            'numeroDocumento' => $this->person->document_number,
            'nombre' => $this->person->name,
            'direccion' => $this->person->addres,
            'telefono' => $this->person->phone,
            'codDepartamento' => $this->person->cod_departament,
            'codProvincia' => $this->person->cod_province,
            'codDistrito' => $this->person->cod_district,
            'FechaRegistro' => $this->created_at,
            'email' => $this->usuario->email,
        ];
    }
}
