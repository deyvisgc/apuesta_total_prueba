<?php

namespace App\Application\UseCases\SalesConsultant; // asesor

use App\Domain\Repositories\SalesConsultantRepositoryInterface;

class FindSalesConsultantByIdUseCase
{ 
    protected $salesConsultantRepositoryInterface;

    public function __construct(SalesConsultantRepositoryInterface $salesConsultantRepositoryInterface)
    {
        $this->salesConsultantRepositoryInterface = $salesConsultantRepositoryInterface;
    }

    public function execute(int $id)
    {
        return $this->salesConsultantRepositoryInterface->find($id);
    }
}
