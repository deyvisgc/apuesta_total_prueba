<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\DepositEntity;

interface DepositRepositoryInterface
{
    public function recargar(DepositEntity $depositEntity);
    public function getAll();
    public function find($id);
    public function updateRecarga($id, DepositEntity $depositEntity);
}
