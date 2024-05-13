<?php

namespace App\Domain\Entities;

class ClientEntity
{
    private $player_id;
    private $balance;
    private $idPerson;

    public function __construct( $player_id, $balance,  $idPerson = null)
    {
        
        $this->player_id = $player_id;
        $this->balance = $balance;
        $this->idPerson = $idPerson;
    }

    public function getPlayerId() {
        return $this->player_id;
    }
    public function getBalance() {
        return $this->balance;
    }
    
    public function getPersonId() {
        return $this->idPerson;
    }
    
    public function setIdPerson($id)
    {
        $this->idPerson = $id;
    }
}
