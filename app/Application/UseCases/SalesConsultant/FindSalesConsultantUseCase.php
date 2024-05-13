<?php

namespace App\Application\UseCases\SalesConsultant; // asesor
use App\Domain\Repositories\SalesConsultantRepositoryInterface;

class FindSalesConsultantUseCase
{ 
    protected $salesConsultantRepositoryInterface;

    public function __construct(SalesConsultantRepositoryInterface $salesConsultantRepositoryInterface)
    {
        $this->salesConsultantRepositoryInterface = $salesConsultantRepositoryInterface;
    }
    public function execute()
    {
        return $this->salesConsultantRepositoryInterface->findAll();
    }
}
