<?php

namespace App\Http\Controllers;

use App\Application\UseCases\General\ComunicationUseCase;
use App\Application\UseCases\General\FindComunicationUseCase;
use App\Application\UseCases\General\FindRoleUseCase;
use App\Application\UseCases\General\UpdateStatusComunicationUseCase;
use App\Http\Resources\ComunicationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GeneralController extends Controller
{
    
    protected $comunicationUseCase;
    protected $findCommunicationUseCase;
    protected $updateStatusComunicationUseCase;
    protected $findRoleUseCase;
    public function __construct(ComunicationUseCase $comunicationUseCase, 
    FindComunicationUseCase $findCommunicationUseCase,
     UpdateStatusComunicationUseCase $updateStatusComunicationUseCase,
     FindRoleUseCase $findRoleUseCase
     )
    {
        $this->comunicationUseCase = $comunicationUseCase;
        $this->findCommunicationUseCase = $findCommunicationUseCase;
        $this->updateStatusComunicationUseCase = $updateStatusComunicationUseCase;
        $this->findRoleUseCase = $findRoleUseCase;
        $this->middleware('auth:api');
    }
    public function list() {
        $result = $this->findCommunicationUseCase->execute();
        return ComunicationResource::collection($result);
    }
    
    public function listBank() {
        $result = $this->findRoleUseCase->executeBank();
        return $result;
    }
    
    public function sendComunication(Request $request)
    {
        $rules = [
            'sales_id' => 'required|integer',
            'id_jugador' => 'required|string',
            'channel' => 'required|string',
            'message' => 'required|string'
        ];

        // Realizar la validación
        $validator = validator()->make($request->all(), $rules);

        // Si la validación falla, devolver las reglas de validación al cliente
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        LOG::info("INICIO => COMUNICACION ENTRE CLIENTE Y ASESOR DE VENTAS AQUI");
        $sales_id  = $request->get('sales_id');
        $id_jugador = $request->get('id_jugador');
        $channel   = $request->get('channel');
        $message   = $request->get('message');
        $response  = $this->comunicationUseCase->execute($sales_id, $id_jugador,  $channel, $message);
        LOG::info("FIN => COMUNICACION ENTRE CLIENTE Y ASESOR DE VENTAS AQUI");
        return $response;
    }
    public function replyMessage(Request $request)
    {
        $rules = [
            'id' => 'required',
            'sales_id' => 'required',
            'idClient' => 'required',
            'message' => 'required|string'
        ];
        // Realizar la validación
        $validator = validator()->make($request->all(), $rules);

        // Si la validación falla, devolver las reglas de validación al cliente
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        LOG::info("INICIO => RESPUESTA A CLIENTE");
        $id  = $request->get('id');
        $sales_id  = $request->get('sales_id');
        $idClient = $request->get('idClient');
        $message   = $request->get('message');
        $response  = $this->comunicationUseCase->executereplyMessage($id, $sales_id , $idClient , $message);
        LOG::info("FIN => COMUNICACION ENTRE CLIENTE Y ASESOR DE VENTAS AQUI");
        return $response;
    }
    
    public function updateStatusComunication(Request $request) {
        $id  = $request->get('id'); // comunicacion
        $status = $request->get('status');
        $result = $this->updateStatusComunicationUseCase->execute($id, $status);
        return $result;
    }
    public function role() {
        $result = $this->findRoleUseCase->execute();
        return $result;
    }
}
