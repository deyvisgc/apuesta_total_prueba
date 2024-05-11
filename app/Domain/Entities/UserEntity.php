<?php

namespace App\Domain\Entities;

class UserEntity
{

    private $email;
    private $password;
    private $idClient;

    public function __construct( $email, $password, $idClient)
    {
        $this->email = $email;
        $this->password = $password;
        $this->idClient = $idClient;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getPasword() {
        return $this->password;
    }
    public function getIdClient() {
        return $this->idClient;
    }
    public function setIdClient($id)
    {
        $this->idClient = $id;
    }
}
