<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Repositories\UbigeoRepositoryInterface;
use App\Models\Departament;
use App\Models\District;
use App\Models\Province;

class EloquentUbigeoRepository implements UbigeoRepositoryInterface
{
    public function findDepartament() {
        $departament = Departament::all();
        return $departament;
    }
    public function findProvince(string $idDepartament) {
        //return $idDepartament;
        $province = Province::where("department_id", $idDepartament)->get();
        return $province;

    }
    public function findDistrict(string $idProv) {
        $province = District::where("province_id", $idProv)->get();
        return $province;
    }
}
