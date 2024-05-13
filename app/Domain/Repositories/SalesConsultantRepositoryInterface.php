<?php

namespace App\Domain\Repositories;
use App\Domain\Entities\PersonEntity;
use App\Domain\Entities\SalesConsultantEntity;
use App\Domain\Entities\UserEntity;

interface SalesConsultantRepositoryInterface
{
    public function findAll();
    public function create(PersonEntity $person, UserEntity $user);
    public function find($id);
    public function update(int $id, SalesConsultantEntity $client);
    public function delete($id);
}
