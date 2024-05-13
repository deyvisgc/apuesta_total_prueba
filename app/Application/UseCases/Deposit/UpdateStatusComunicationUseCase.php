<?php

namespace App\Application\UseCases\General; // asesor

use App\Domain\Repositories\GeneralRepositoryInterface;

class UpdateStatusComunicationUseCase
{ 
  
    protected $generalRepositoryInterface;

    public function __construct(GeneralRepositoryInterface $generalRepositoryInterface)
    {
        $this->generalRepositoryInterface = $generalRepositoryInterface;
    }

    public function execute($id, $status)
    {
        return $this->generalRepositoryInterface->updateStatus($id, $status);
    }
}
