<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\ClientEntity;
use App\Domain\Entities\PersonEntity;
use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Repositories\UsersRepositoryInterface;
use App\Models\Client as ModelClient;
use App\Models\Person as ModelPerson;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class EloquentClientRepository implements ClientRepositoryInterface
{
    protected $usersRepositoryInterface;

    public function __construct(UsersRepositoryInterface $usersRepositoryInterface)
    {
        $this->usersRepositoryInterface = $usersRepositoryInterface;
    }
    public function findAll() {
        $clientesConUsuarios = ModelClient::with('user', 'person')->get();
        return $clientesConUsuarios;
    }
    public function find($id) {
        $clientes = ModelClient::with('user', 'person')->find($id);
        return  $clientes;
    }
    
    public function create(PersonEntity $personEntity, ClientEntity $clientEntity, UserEntity $userEntity)
    {
        try {
            // Inicia una transacción
            DB::beginTransaction();
            $person = new ModelPerson();
            $person->name = $personEntity->getName();
            $person->document_type = $personEntity->getDocumentType();
            $person->document_number = $personEntity->getDocumentNumber();
            $person->phone = $personEntity->getPhone();
            $person->addres = $personEntity->getAddres();
            $person->cod_departament = $personEntity->getCodDepar();
            $person->cod_province = $personEntity->getCodProv();
            $person->cod_district = $personEntity->getCodDist();
            $person->save();

            $clientEntity->setIdPerson($person->id);
            $clientModel = new ModelClient();
            $clientModel->player_id = $clientEntity->getPlayerId();
            $clientModel->balance = $clientEntity->getBalance();
            $clientModel->person_id = $clientEntity->getPersonId();
            $clientModel->save();
            
            $userEntity->setIdClient($clientModel->id);
            $this->usersRepositoryInterface->create($userEntity);
            // Si todo va bien, confirma la transacción
            DB::commit();
            $res = [
                'message' => 'Cuenta creada exitosamente!',
                'status' => 'success',
                'data' => $clientEntity
            ];
            return response()->json($res, 201);
        } catch (QueryException $e) {
            Log::error('Error al crear cliente y usuario: ' . $e->getMessage());
            // Revertir la transacción
            DB::rollback();
            return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 409);
        }
        catch (\Exception $e) {
            // En caso de una excepción, revierte la transacción
            DB::rollback();
        }
    }
    public function update(int $id, ClientEntity $client){
        try {
            $cliente = ModelClient::find($id);
            // if ($cliente) {
            //     $update = [
            //         'name' => $client->getName(),
            //         'document_type' => $client->getDocumentType(),
            //         'document_number' => $client->getDocumentNumber(),
            //         'phone' => $client->getPhone(),
            //         'addres' => $client->getAddres(),
            //         'cod_departament' => $client->getCodDepar(),
            //         'cod_province' => $client->getCodProv(),
            //         'cod_district' =>  $client->getCodDist()
            //     ];
            //         // Inicia una transacción
            //     DB::beginTransaction();
            //     // Si todo va bien, confirma la transacción
            //     DB::commit();
            //     // Otros procesos después de la transacción exitosa
            //     $res = [
            //         'message' => 'Cuenta creada exitosamente!',
            //         'status' => 'success',
            //         'data' => $client
            //     ];
            //     return response()->json($res, 403);
            //     // Actualiza los campos con los nuevos datos
            //     //$cliente->update($nuevosDatos);
            
            //     // Guarda los cambios en la base de datos
            //     $cliente->save();
            
            //     // O simplemente puedes usar el método update directamente sin necesidad de save()
            //     // $cliente->update($nuevosDatos);
            
            //     // Si quieres hacer algo después de la actualización, puedes hacerlo aquí
            // } else {
            //     // Manejar el caso en que el cliente no exista
            // }
            
        } catch (QueryException $e) {
            Log::error('Error al crear cliente y usuario: ' . $e->getMessage());
            // Revertir la transacción
            DB::rollback();
            return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 409);
        }
        catch (\Exception $e) {
            // En caso de una excepción, revierte la transacción
            DB::rollback();
        }
    }
    public function delete($id) {

    }

    // Implementa los métodos restantes de la interfaz...
}
