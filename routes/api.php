<?php

use App\Http\Controllers\Api\BaixadaAPIController;
use App\Http\Controllers\Api\IAMController;
use App\Http\Controllers\Api\ParamController;
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

Route::prefix('iam')->name('iam.')->group(function () {
    Route::post('/login', [IAMController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('param')->name('param.')->group(function () {
        Route::get('/districts', [ParamController::class, 'districts'])->name('districts');
        Route::get('/baixada_info', [BaixadaAPIController::class, 'baixada_info'])->name('baixada_info');
    });

    Route::prefix('baixada')->name('baixada.')->group(function () {
        Route::post('/', [BaixadaAPIController::class, 'store'])->name('store');
        Route::get('/', [BaixadaAPIController::class, 'index'])->name('index');
    });

});
