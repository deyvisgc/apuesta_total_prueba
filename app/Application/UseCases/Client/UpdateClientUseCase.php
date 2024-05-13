<?php

namespace App\Application\UseCases\Client;

use App\Domain\Entities\ClientEntity;
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

    public function execute(int $id, string $document_type, string $document_number, string $name, int $phone,
    float $balance, string $addres, string $codDepar, string $codProvince, string $codDistri)
    {
        $player_id = Str::uuid()->toString(). '_' . $document_number;
        $cliente = new ClientEntity($document_type, $document_number, $name, $phone, $player_id, $balance, $addres, $codDepar, $codProvince, $codDistri);
        return $this->clientRepositoryInterface->update($id, $cliente);
    }
   
}