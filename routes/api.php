<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SalesConsultantController;
use App\Http\Controllers\UbigeoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function () {
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index']);
        Route::get('/search-document/{id}', [ClientController::class, 'searchDocumentDni']);
        Route::get('/{id}', [ClientController::class, 'show']);
        Route::post('/', [ClientController::class, 'store']);
    });

    Route::prefix('sales')->group(function () { // Asesores de ventas
        Route::get('/', [SalesConsultantController::class, 'index']);
        Route::get('/{id}', [SalesConsultantController::class, 'show']);
        Route::post('/', [SalesConsultantController::class, 'store']);
        // Route::put('/{id}', [ClientController::class, 'update']);
        // Route::delete('/{id}', [ClientController::class, 'destroy']);
    });

    Route::prefix('general')->group(function () {
        Route::get('/comunication/list', [GeneralController::class, 'list']);
        Route::get('/role', [GeneralController::class, 'role']);
        Route::get('/bank', [GeneralController::class, 'listBank']);
        Route::post('/comunication', [GeneralController::class, 'sendComunication']);
        Route::put('/comunication/c', [GeneralController::class, 'updateStatusComunication']);
        Route::post('/comunication/reply', [GeneralController::class, 'replyMessage']);
    });

    Route::prefix('deposit')->group(function () {
        Route::post('/recargar', [DepositController::class, 'recargar']);
        Route::get('/list', [DepositController::class, 'list']);
        Route::get('/list/{id}', [DepositController::class, 'find']);
        Route::post('/recargar/{id}', [DepositController::class, 'updateRecarga']);
        // Route::delete('/{id}', [ClientController::class, 'destroy']);
    });

    Route::prefix('ubigeo')->group(function () {
        Route::get('/departament', [UbigeoController::class, 'findDepartament']);
        Route::get('/province/{id}', [UbigeoController::class, 'findProvince']);
        Route::get('/distrito/{id}', [UbigeoController::class, 'findDistrict']);
    });

    // Rutas dentro del grupo 'auth'
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::post('register', [AuthController::class, 'register']);
    });
});