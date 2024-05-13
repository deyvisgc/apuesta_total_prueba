<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\ComunicationEntity;
use App\Domain\Repositories\GeneralRepositoryInterface;
use App\Models\Bank;
use App\Models\Client;
use App\Models\Comunication as ModelComunication;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class EloquentGeneralRepository implements GeneralRepositoryInterface
{
    public function sendComunication(ComunicationEntity $comunicationEntity) {
        try {
            $client = Client::where('player_id', $comunicationEntity->getIdJugador())->first();
            if ($client != null) {
                $comunicationModel = new ModelComunication();
                $comunicationModel->sales_id = $comunicationEntity->getSalesId();
                $comunicationModel->client_id = $client->id;
                $comunicationModel->channel = $comunicationEntity->getChanel();
                $comunicationModel->message = $comunicationEntity->getMessage();
                $comunicationModel->status = "1";  // 1 => enviado, 2 = visto, 3 = finalizado
                $comunicationModel->save();
                $res = [
                    'message' => 'Mensaje enviado. Espere mientras nuestro asesor de ventas lo revisa. Consulte su historial de comunicación.!',
                    'status' => 'success'
                ];
                return response()->json($res, 201);
            }
            
        } catch (QueryException $e) {
            Log::error('Error al crear la comunicacion: ' . $e->getMessage());
            return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 409);
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    
    public function replyMessage($id, $sales_id , $idClient , $message) {
        try {
            $comunicacion = ModelComunication::find($id);
            $comunicationModel = new ModelComunication();
            $comunicationModel->channel = $comunicacion->channel;
            $comunicationModel->sales_id = $sales_id;
            $comunicationModel->client_id = $idClient;
            $comunicationModel->message = $message;
            $comunicationModel->status = "2";  // 1 => enviado, 2 = respondido
            $comunicationModel->save();
            $res = [
                'message' => 'Mensaje enviado. en respuesta al cliente.!',
                'status' => 'success'
            ];
            return response()->json($res, 201); 
        } catch (QueryException $e) {
            Log::error('Error al responder la comunicacion: ' . $e->getMessage());
            return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 409);
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function findComunication() { 
        $clientes = ModelComunication::with('client.person', 'client.user', 'asesor.person')->get();
        return  $clientes;
    }
    public function updateStatus($id, $status) {
        try {
            $communication = ModelComunication::find($id);
            if ($communication) {
                $communication->status = $status;
                $communication->save();
                $res = [
                    'message' => 'Estado de la comunicación actualizado correctamente.',
                    'status' => 'success'
                ];
                return response()->json($res, 201);
            } else {
                $res = [
                    'message' => 'La comunicación no fue encontrada.',
                    'status' => 'false'
                ];
                return response()->json($res, 403);
            }
        } catch (QueryException $e) {
            Log::error('Error al crear la comunicacion: ' . $e->getMessage());
            return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 409);
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function findRole() {
       return Role::all();
    }
    public function findBank() {
        return Bank::all();
    }
}
