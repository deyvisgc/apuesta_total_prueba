<?php

namespace App\Application\UseCases\Ubigeo;

use App\Domain\Repositories\UbigeoRepositoryInterface;

class FindDepartamentUseCase
{
    protected $ubigeoRepository;

    public function __construct(UbigeoRepositoryInterface $ubigeoRepositoryInterface)
    {
        $this->ubigeoRepository = $ubigeoRepositoryInterface;
    }

    public function execute()
    {
        return $this->ubigeoRepository->findDepartament();
    }
}
