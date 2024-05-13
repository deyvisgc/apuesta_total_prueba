<?php

namespace App\Application\UseCases\General; // asesor

use App\Domain\Repositories\GeneralRepositoryInterface;

class FindComunicationUseCase
{ 
  
    protected $generalRepositoryInterface;

    public function __construct(GeneralRepositoryInterface $generalRepositoryInterface)
    {
        $this->generalRepositoryInterface = $generalRepositoryInterface;
    }

    public function execute()
    {
        return $this->generalRepositoryInterface->findComunication();
    }
}
