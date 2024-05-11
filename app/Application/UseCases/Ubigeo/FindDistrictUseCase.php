<?php


namespace App\Application\UseCases\Ubigeo;

use App\Domain\Repositories\UbigeoRepositoryInterface;

class FindDistrictUseCase
{
    protected $ubigeoRepository;

    public function __construct(UbigeoRepositoryInterface $ubigeoRepositoryInterface)
    {
        $this->ubigeoRepository = $ubigeoRepositoryInterface;
    }

    public function execute( string $idProvince)
    {
        return $this->ubigeoRepository->findDistrict($idProvince);
    }
}
