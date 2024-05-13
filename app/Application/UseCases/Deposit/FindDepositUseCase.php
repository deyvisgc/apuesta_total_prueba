<?php

namespace App\Application\UseCases\Deposit;

use App\Domain\Repositories\DepositRepositoryInterface;

class FindDepositUseCase
{ 
  
   
    protected $depositRepositoryInterface;

    public function __construct(DepositRepositoryInterface $depositRepositoryInterface)
    {
        $this->depositRepositoryInterface = $depositRepositoryInterface;
    }

    public function execute()
    {
        return $this->depositRepositoryInterface->getAll();
    }
    public function executeById($id)
    {
        return $this->depositRepositoryInterface->find($id);
    }
}
