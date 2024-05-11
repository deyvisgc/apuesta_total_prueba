<?php


namespace App\Application\UseCases\Ubigeo;

use App\Domain\Repositories\UbigeoRepositoryInterface;

class FindProvinceUseCase
{
    protected $ubigeoRepository;

    public function __construct(UbigeoRepositoryInterface $ubigeoRepositoryInterface)
    {
        $this->ubigeoRepository = $ubigeoRepositoryInterface;
    }

    public function execute(string $idDepar)
    {
        return $this->ubigeoRepository->findProvince($idDepar);
    }
}
