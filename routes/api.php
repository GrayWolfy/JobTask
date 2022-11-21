<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ParseController;
use App\Http\Controllers\Api\RentController;
use App\Http\Controllers\CarController;
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

Route::post('/auth/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/parse', [ParseController::class, 'parse'])->name('pass');
Route::post('/message/create', [MessageController::class, 'create'])->name('message.create');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    /** Car Rent Block */
    Route::get('/car/index', [CarController::class, 'index'])->name('index');
    Route::get('/car/{car}', [CarController::class, 'show'])->name('show');
    Route::get('/car/rent/{car}', [RentController::class, 'rent'])
        ->name('rent')
        ->middleware('rentable');
    Route::get('/car/finishRent/{car}', [RentController::class, 'finishRent'])
        ->name('finishRent')
        ->middleware('finishRent');

    /** Contact Message Block */
    Route::get('/message/index', [MessageController::class, 'index'])->name('showAll');
    Route::get('/message/getRead', [MessageController::class, 'getRead'])->name('getRead');
    Route::get('/message/getDeleted', [MessageController::class, 'getDeleted'])->name('getDeleted');
    Route::get('/message/getByPhoneNumber', [MessageController::class, 'getByPhoneNumberDigits'])
        ->name('getByDigits');
    Route::put('/message/update/{contactMessage}', [MessageController::class, 'update']);
    Route::put('/message/setRead/{contactMessage}', [MessageController::class, 'setRead']);
    Route::put('/message/restore/{contactMessage}', [MessageController::class, 'enable']);
    Route::delete('/message/delete/{contactMessage}',[MessageController::class, 'delete']);

});
