<?php

namespace App\Application\UseCases\Client;

use App\Domain\Repositories\ClientRepositoryInterface;

class FindClientUseCase
{ 
    protected $clientRepositoryInterface;

    public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
    {
        $this->clientRepositoryInterface = $clientRepositoryInterface;
    }

    public function execute()
    {
        return $this->clientRepositoryInterface->findAll();
    }
}
