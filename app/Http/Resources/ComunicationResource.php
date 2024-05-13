<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComunicationResource extends JsonResource
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
             'canal' => $this->channel,
             'mensaje' => $this->message,
             'fecha_registro' => $this->created_at,
             'estado' => $this->status,
             'idJugador' => $this->client->player_id,
             'personId' => $this->client->person_id,
             'clientId' => $this->client->id,
             'nombreCliente' => $this->client->person->name,
             'nombreAsesor' => $this->asesor->person->name,
             'role' => $this->client->user->role_id,
         ];
     }
}
