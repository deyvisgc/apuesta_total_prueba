<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Ubigeo\FindDepartamentUseCase;
use App\Application\UseCases\Ubigeo\FindDistrictUseCase;
use App\Application\UseCases\Ubigeo\FindProvinceUseCase;
use App\Http\Resources\DepartamentResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\ProvinceResource;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    protected $findDepartamentUseCase;
    protected $findProvinceUseCase;
    protected $findDistrictUseCase;

    public function __construct(FindDepartamentUseCase $findDepartamentUseCase, 
    FindProvinceUseCase $findProvinceUseCase,
    FindDistrictUseCase $findDistrictUseCase
    )
    {
        $this->findDepartamentUseCase = $findDepartamentUseCase;
        $this->findProvinceUseCase = $findProvinceUseCase;
        $this->findDistrictUseCase = $findDistrictUseCase;
        $this->middleware('auth:api', ['except' => ['findDepartament', 'findProvince', 'findDistrict']]);
    }

    public function findDepartament() {
      $result = $this->findDepartamentUseCase->execute();
      return DepartamentResource::collection($result);
    }
    public function findProvince(string $idDepar) {
        $result = $this->findProvinceUseCase->execute($idDepar);
        return ProvinceResource::collection($result);
    }
    public function findDistrict(string $idProvin) {
        $result = $this->findDistrictUseCase->execute($idProvin);
        return DistrictResource::collection($result);
    }
}
