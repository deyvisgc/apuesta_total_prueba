<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UsersRepositoryInterface;
use App\Models\User as ModelsUser;
class EloquentUsersRepository implements UsersRepositoryInterface
{
    public function create(UserEntity $userEntity)
    {
        $users = new ModelsUser();
        $users->email = $userEntity->getEmail();
        $users->password = bcrypt($userEntity->getPasword());
        $users->client_id = $userEntity->getIdClient();
        $users->sales_id = $userEntity->getIdSales();
        $users->role_id = $userEntity->getRole();
        $users->save();
    }
    public function find($id) {

    }
    public function update(int $id, UserEntity $userEntity){

    }
    public function delete($id) {

    }

    // Implementa los métodos restantes de la interfaz...
}
