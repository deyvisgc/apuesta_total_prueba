<?php

namespace App\Domain\Entities;

class UserEntity
{

    private $email;
    private $password;
    private $idClient;
    private $idSales;
    private $role;

    public function __construct( string $email = null, string $password = null, int $role, $idClient = null, $idSales = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->idClient = $idClient;
        $this->idSales = $idSales;
        $this->role = $role;
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
    public function getIdSales() {
        return $this->idSales;
    }
    
    
    public function getRole() {
        return $this->role;
    }
    public function setIdClient($id)
    {
        $this->idClient = $id;
    }
    public function setIdSales($id)
    {
        $this->idSales = $id;
    }
}
