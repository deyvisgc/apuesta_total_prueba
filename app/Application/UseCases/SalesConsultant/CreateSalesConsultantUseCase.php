<?php

namespace App\Application\UseCases\SalesConsultant; // asesor

use App\Domain\Entities\PersonEntity;
use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\SalesConsultantRepositoryInterface;
class CreateSalesConsultantUseCase
{
    protected $salesConsultantRepositoryInterface;

    public function __construct(SalesConsultantRepositoryInterface $salesConsultantRepositoryInterface)
    {
        $this->salesConsultantRepositoryInterface = $salesConsultantRepositoryInterface;
    }

    public function execute(string $document_type, string $document_number, string $name, int $phone, string $email, string $password, string $addres, string $codDepar, string $codProvince, string $codDistri, int $role)
    {
        $person = new PersonEntity($document_type, $document_number, $name, $phone,$addres, $codDepar, $codProvince, $codDistri);
        $users = new UserEntity($email, $password, $role);
        return $this->salesConsultantRepositoryInterface->create($person, $users);
    }
   
}