<?php

use App\Http\Controllers\Api\ParticipantController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\UserController;
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

    Route::get('cities', [CityController::class, 'index']);
    Route::get('users', [UserController::class, 'index']);

    Route::get('events', [EventController::class, 'index']);
    Route::get('events/{event}/show', [EventController::class, 'show']);
    Route::delete('events/{event}/delete', [EventController::class, 'delete']);

    Route::get('participants', [ParticipantController::class, 'index']);
    Route::post('participants/store', [ParticipantController::class, 'store']);
    Route::post('participants/{participant}/update', [ParticipantController::class, 'update']);
    Route::delete('participants/{participant}/delete', [ParticipantController::class, 'delete']);
    Route::get('participants/{participant}/show', [ParticipantController::class, 'show']);
});
