<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Client;
use App\Domain\Entities\ClientEntity;
use App\Domain\Entities\UserEntity;

interface ClientRepositoryInterface
{
    public function create(ClientEntity $client, UserEntity $user);
    public function find($id);
    public function update(int $id, ClientEntity $client);
    public function delete($id);
}
