<?php

namespace App\Domain\Repositories;

interface UbigeoRepositoryInterface
{
    public function findDepartament();
    public function findProvince(string $idDepartament);
    public function findDistrict(string $idProv);
}
