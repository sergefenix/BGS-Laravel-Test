<?php

use App\Http\Controllers\Api\ApiParticipantController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\ApiEventController;
use App\Http\Controllers\Api\ApiCityController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Auth\LoginController;
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

Route::post('register', [RegisterController::class, 'register'])->middleware('guest');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');

Route::group(['middleware' => 'auth:api'], static function () {

    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('cities', [ApiCityController::class, 'index']);
    Route::get('users', [ApiUserController::class, 'index']);

    Route::get('events', [ApiEventController::class, 'index']);
    Route::get('events/{event}/show', [ApiEventController::class, 'show']);
    Route::delete('events/{event}/delete', [ApiEventController::class, 'delete']);

    Route::get('participants', [ApiParticipantController::class, 'index']);
    Route::post('participants/store', [ApiParticipantController::class, 'store']);
    Route::post('participants/{participant}/update', [ApiParticipantController::class, 'update']);
    Route::delete('participants/{participant}/delete', [ApiParticipantController::class, 'delete']);
    Route::get('participants/{participant}/show', [ApiParticipantController::class, 'show']);
});
