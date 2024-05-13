<?php

namespace App\Application\UseCases\Client;

use App\Domain\Repositories\ClientRepositoryInterface;

class FindClientByIdUseCase
{ 
    protected $clientRepositoryInterface;

    public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
    {
        $this->clientRepositoryInterface = $clientRepositoryInterface;
    }

    public function execute(int $id)
    {
        return $this->clientRepositoryInterface->find($id);
    }
}
