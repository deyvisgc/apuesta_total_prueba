<?php

namespace App\Domain\Entities;

class ComunicationEntity
{
    private $sales_id;
    private $channel;
    private $message;
    private $id_jugador;

    public function __construct( $sales_id, $id_jugador,  $channel, $message)
    {

        $this->sales_id = $sales_id;
        $this->channel = $channel;
        $this->message = $message;
        $this->id_jugador = $id_jugador;
    }

    public function getIdJugador() {
        return $this->id_jugador;
    }
    public function getSalesId() {
        return $this->sales_id;
    }
    public function getChanel() {
        return $this->channel;
    }
    
    public function getMessage() {
        return $this->message;
    }
}
