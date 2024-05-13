<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\PersonEntity;
use App\Domain\Entities\SalesConsultantEntity;
use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\SalesConsultantRepositoryInterface;
use App\Domain\Repositories\UsersRepositoryInterface;
use App\Models\Person as ModelPerson;
use App\Models\SalesConsultant as ModelSalesConsultant;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class EloquentSalesConsultantRepository implements SalesConsultantRepositoryInterface
{
    protected $usersRepositoryInterface;

    public function __construct(UsersRepositoryInterface $usersRepositoryInterface)
    {
        $this->usersRepositoryInterface = $usersRepositoryInterface;
    }
    public function findAll() {
        $clientesConUsuarios = ModelSalesConsultant::with('usuario', 'person')->get();
        return $clientesConUsuarios;
    }
    public function find($id) {
        $clientes = ModelSalesConsultant::with('usuario', 'person')->find($id);
        return  $clientes;
    }
    
    public function create(PersonEntity $personEntity, UserEntity $userEntity)
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
            $salesModel = new ModelSalesConsultant();
            $salesModel->person_id = $person->id;
            $salesModel->save();
            $userEntity->setIdSales($salesModel->id);
            $this->usersRepositoryInterface->create($userEntity);
            // Si todo va bien, confirma la transacción
            DB::commit();
            $res = [
                'message' => 'Cuenta creada exitosamente!',
                'status' => 'success'
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
    public function update(int $id, SalesConsultantEntity $sales){
        try {
            return null;
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
