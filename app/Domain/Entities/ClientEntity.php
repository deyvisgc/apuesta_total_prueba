<?php

namespace App\Domain\Entities;

class ClientEntity
{
    private $document_type;
    
    private $document_number;
    private $name;
    private $phone;
    private $player_id;
    private $balance;

    public function __construct($document_type, $document_number, $name, $phone, $player_id, $balance)
    {
        $this->document_type = $document_type;
        $this->document_number = $document_number;
        $this->name = $name;
        $this->phone = $phone;
        $this->player_id = $player_id;
        $this->balance = $balance;
    }
    public function getDocumentType() {
        return $this->document_type;
    }
    public function getDocumentNumber() {
        return $this->document_number;
    }
    public function getName() {
        return $this->name;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function getPlayerId() {
        return $this->player_id;
    }
    public function getBalance() {
        return $this->balance;
    }
}
