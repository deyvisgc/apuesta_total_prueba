<?php

namespace App\Application\UseCases\Client;

use App\Domain\Entities\ClientEntity;
use App\Domain\Entities\PersonEntity;
use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\ClientRepositoryInterface;
use Illuminate\Support\Str;
class CreateClientUseCase
{
    protected $clientRepositoryInterface;

    public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
    {
        $this->clientRepositoryInterface = $clientRepositoryInterface;
    }

    public function execute(string $document_type, string $document_number, string $name, int $phone,
    float $balance, string $email, string $password, string $addres, string $codDepar, string $codProvince, string $codDistri, int $role)
    {
        $player_id = Str::uuid()->toString(). '_' . $document_number;
        $person = new PersonEntity($document_type, $document_number, $name, $phone,$addres, $codDepar, $codProvince, $codDistri);
        $cliente = new ClientEntity($player_id, $balance);
        $users = new UserEntity($email, $password, $role);
        return $this->clientRepositoryInterface->create($person , $cliente, $users);
    }
   
}