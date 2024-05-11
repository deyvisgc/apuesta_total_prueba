<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\ClientEntity;
use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Models\Models\Client as ModelsClient;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EloquentClientRepository implements ClientRepositoryInterface
{
    protected $usuarioRepository;

    public function __construct(EloquentUsersRepository $eloquentUsersRepository)
    {
        $this->usuarioRepository = $eloquentUsersRepository;
    }
    public function create(ClientEntity $client, UserEntity $user)
    {
        try {
            // Inicia una transacción
            DB::beginTransaction();
            $clientModel = new ModelsClient();
            $clientModel->name = $client->getName();
            $clientModel->document_type = $client->getDocumentType();
            $clientModel->document_number = $client->getDocumentNumber();
            $clientModel->phone = $client->getPhone();
            $clientModel->player_id = Str::uuid()->toString(). '_' . $client->getDocumentNumber();
            $clientModel->balance = $client->getPlayerId();
            $clientModel->save();
            $user->setIdClient($clientModel->id);
            $this->usuarioRepository->create($user);
            // Si todo va bien, confirma la transacción
            DB::commit();
            // Otros procesos después de la transacción exitosa
        } catch (\Exception $e) {
            // En caso de una excepción, revierte la transacción
            DB::rollback();
            // Maneja la excepción (registra, notifica, muestra un mensaje de error, etc.)
            // Por ejemplo, muestra el mensaje de error
            dd($e->getMessage());
        }
        return $clientModel;
    }
    public function find($id) {

    }
    public function update(int $id, ClientEntity $client){

    }
    public function delete($id) {

    }
    public function findByCodDocument(int $number) {

    }

    // Implementa los métodos restantes de la interfaz...
}
