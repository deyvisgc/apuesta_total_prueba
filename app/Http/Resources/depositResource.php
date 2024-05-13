<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class depositResource extends JsonResource
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
            'client_id' => $this->client_id,
            'voucher' => $this->voucher,
            'canal' => $this->chanel,
            'monto' => $this->amount,
            'fechaHora' => $this->date_hour,
            'player_id' => $this->client->player_id,
            'nombreCLiente' => $this->client->person->name,
            'name_bank' => $this->bank->name,
            'id_bank'  => $this->bank->id
        ];
    }
}
