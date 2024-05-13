<?php

namespace App\Domain\Entities;

class PersonEntity
{
    private $document_type;
    
    private $document_number;
    private $name;
    private $phone;
    private $codProv;
    private $addres;
    private $codDepar;
    private $codDist;

    public function __construct($document_type, $document_number, $name, $phone, $addres, $codDepar, $codProv, $codDist)
    {
        $this->document_type = $document_type;
        $this->document_number = $document_number;
        $this->name = $name;
        $this->phone = $phone;
        $this->addres = $addres;
        $this->codDepar = $codDepar;
        $this->codProv = $codProv;
        $this->codDist = $codDist;
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
    
    public function getAddres() {
        return $this->addres;
    }
    
    public function getCodDepar() {
        return $this->codDepar;
    }
    
    public function getCodProv() {
        return $this->codProv;
    }
    
    public function getCodDist() {
        return $this->codDist;
    }

}
