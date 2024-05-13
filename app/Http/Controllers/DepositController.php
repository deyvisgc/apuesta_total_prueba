<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Deposit\FindDepositUseCase;
use App\Application\UseCases\Deposit\RecargarDepositUseCase;
use App\Application\UseCases\Deposit\UpdateRecargaDepositUseCase;
use App\Http\Resources\depositResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepositController extends Controller
{
    
    protected $recargarDepositUseCase;
    protected $updateRecargaDepositUseCase;
    protected $findDepositUseCase;
    public function __construct(RecargarDepositUseCase $recargarDepositUseCase,
     UpdateRecargaDepositUseCase $updateRecargaDepositUseCase, FindDepositUseCase $findDepositUseCase )
    {
        $this->recargarDepositUseCase = $recargarDepositUseCase;
        $this->updateRecargaDepositUseCase = $updateRecargaDepositUseCase;
        $this->findDepositUseCase = $findDepositUseCase;
        $this->middleware('auth:api');

    }
    public function list() {
        $result = $this->findDepositUseCase->execute();

        return depositResource::collection($result);
    }
    public function find($id) {
        $result = $this->findDepositUseCase->executeById($id);
        return new depositResource($result);
    }
    public function recargar(Request $request)
    {
        $rules = [
            'voucher' => 'required|file|mimes:jpeg,png|max:2048',
            'chanel' => 'required|string',
            'amount' => 'required|numeric|gt:0',
            'bank_id' => 'required|integer',
            'date_hour' => 'required|string',
            'player_id' => 'required|string'
        ];

        // Realizar la validación
        $validator = validator()->make($request->all(), $rules);

        // Si la validación falla, devolver las reglas de validación al cliente
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        LOG::info("INICIO => RECARGA DE MONTO");

        if ($request->hasFile('voucher')) {
            $voucher = $request->file('voucher');
            // Guardar el archivo en el almacenamiento
            $rutaAlmacenamiento = $voucher->store('archivos');
            $chanel = $request->get('chanel');
            $amount   = $request->get('amount');
            $bank_id   = $request->get('bank_id');
            $date_hour   = $request->get('date_hour');
            $player_id   = $request->get('player_id');
            $response  = $this->recargarDepositUseCase->execute($player_id, $rutaAlmacenamiento,  $amount, $bank_id, $date_hour, $chanel);
            LOG::info("FIN => RECARGA DE MONTO");
            return $response;
        }
    
    }
    public function updateRecarga($id, Request $request) {
        $rules = [
            'chanel' => 'required|string',
            'amount' => 'required|numeric|gt:0',
            'bank_id' => 'required|integer',
            'date_hour' => 'required|string',
            'player_id' => 'required|string'
        ];
        // Realizar la validación
        $validator = validator()->make($request->all(), $rules);
        // Si la validación falla, devolver las reglas de validación al cliente
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        LOG::info("INICIO => UPDATE RECARGA DE MONTO");
        $rutaAlmacenamiento = "";
        if ($request->hasFile('voucher')) {
            $voucher = $request->file('voucher');
            $rutaAlmacenamiento = $voucher->store('archivos');
        }
        $chanel = $request->get('chanel');
        $amount   = $request->get('amount');
        $bank_id   = $request->get('bank_id');
        $date_hour   = $request->get('date_hour');
        $player_id   = $request->get('player_id');
        $response  = $this->updateRecargaDepositUseCase->execute($id, $player_id, $rutaAlmacenamiento,  $amount, $bank_id, $date_hour, $chanel);
        LOG::info("FIN => UPDATE RECARGA DE MONTO");
        return $response;
    }
}
