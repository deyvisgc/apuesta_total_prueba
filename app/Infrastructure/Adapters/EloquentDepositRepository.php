<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\DepositEntity;
use App\Domain\Repositories\DepositRepositoryInterface;
use App\Models\Client;
use App\Models\Deposit;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EloquentDepositRepository implements DepositRepositoryInterface
{
    
    public function getAll() {
        $result = Deposit::with('client.person', 'bank')->get();
        return $result;
    }
    public function find($id) {
        $result = Deposit::with('client.person', 'bank')->where('id', $id)->first();
        return $result;
    }
    public function recargar(DepositEntity $depositEntity) {
        try {
            DB::beginTransaction();
            $client = Client::where('player_id', $depositEntity->getPlayerId())->first();
            if ($client != null) {
                $deposito = new Deposit();
                $deposito->client_id =$client->id;
                $deposito->voucher =$depositEntity->getVoucher();
                $deposito->amount =$depositEntity->getAmount();
                $deposito->bank_id =$depositEntity->getBankId();
                $deposito->date_hour =$depositEntity->getDateHour();
                $deposito->chanel =$depositEntity->getChanel();
                $deposito->save();
                $newAmount = $client->balance + $depositEntity->getAmount();
                Client::where('id', $client->id)->update(['balance' => $newAmount]);
                DB::commit();
                $res = [
                    'message' => 'Recarga realizada!',
                    'status' => 'success'
                ];
                return response()->json($res, 201);
            } else {
                return response()->json(['error' => 'No existe informacion con el id jugador: ' .  $depositEntity->getPlayerId()], 409);
            }
        } catch (QueryException $e) {
            Log::error('Error al recargar: ' . $e->getMessage());
            DB::rollback();
            return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 409);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function updateRecarga($id, DepositEntity $depositEntity) {
           try {
            DB::beginTransaction();
            $deposi = Deposit::find($id);
            $client = Client::where('player_id', $depositEntity->getPlayerId())->first();
            if ($deposi &&  $client) {

                if ($depositEntity->getVoucher()) {
                    $deposi->voucher =$depositEntity->getVoucher();
                }
                $deposi->amount = $depositEntity->getAmount();
                $deposi->bank_id =$depositEntity->getBankId();
                $deposi->date_hour =$depositEntity->getDateHour();
                $deposi->chanel =$depositEntity->getChanel();
                $deposi->save();
                $oldAmount = $client->balance - $deposi->amount; // Resto porque primero tengo que dejar el monto del cliente como estaba anteriormente
        
                //$newAmount = $oldAmount + $depositEntity->getAmount(); 
    
                Client::where('id', $client->id)->update(['balance' => $oldAmount]);
                DB::commit();
                $res = [
                    'message' => 'Recarga actualizad!',
                    'status' => 'success'
                ];
                return response()->json($res, 201);
            } else {
                $res = [
                    'message' => 'No existe informaciòn con el id del deposito o del cliente.',
                    'status' => 'false'
                ];
                return response()->json($res, 403);
            }
        } catch (QueryException $e) {
            Log::error('Error al recargar: ' . $e->getMessage());
            DB::rollback();
            return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 409);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

}
