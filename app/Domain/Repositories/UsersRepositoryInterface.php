<?php

namespace App\Domain\Repositories;
use App\Domain\Entities\UserEntity;

interface UsersRepositoryInterface
{
    public function create(UserEntity $userEntity);
    public function find($id);
    public function update(int $id, UserEntity $userEntity);
    public function delete($id);
}
