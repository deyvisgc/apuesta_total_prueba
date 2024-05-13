<?php

namespace App\Domain\Entities;

class SalesConsultantEntity
{
    private $idPerson;

    public function __construct($idPerson = null)
    {
    
        $this->idPerson = $idPerson;
    }
    
    public function getPersonId() {
        return $this->idPerson;
    }
    
    public function setIdPerson($id)
    {
        $this->idPerson = $id;
    }
}
