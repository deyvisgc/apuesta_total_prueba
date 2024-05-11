<?php

use App\Http\Controllers\ClientController;
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

Route::prefix('clients')->group(function () {
    Route::get('/search-document/{id}', [ClientController::class, 'searchDocumentDni']);

    // Route::post('/', [ClientController::class, 'store']);
    // Route::get('/{id}', [ClientController::class, 'show']);
    // Route::put('/{id}', [ClientController::class, 'update']);
    // Route::delete('/{id}', [ClientController::class, 'destroy']);
});

Route::prefix('ubigeo')->group(function () {
    Route::get('/departament', [UbigeoController::class, 'findDepartament']);
    Route::get('/province/{id}', [UbigeoController::class, 'findProvince']);
    Route::get('/distrito', [UbigeoController::class, 'findDistrict']);
});
