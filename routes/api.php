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

Route::group(
    ['middleware' => 'auth:api'],
    static function () {
        Route::post('logout', [LoginController::class, 'logout']);

        Route::get('cities', [CityController::class, 'index']);
        Route::get('users', [UserController::class, 'index']);

        Route::prefix('events')->group(
            function () {
                Route::get('/', [EventController::class, 'index']);
                Route::get('{event}/show', [EventController::class, 'show']);
                Route::delete('{event}/delete', [EventController::class, 'delete']);
            }
        );

        Route::prefix('participants')->group(
            function () {
                Route::get('/', [ParticipantController::class, 'index']);
                Route::post('store', [ParticipantController::class, 'store']);
                Route::post('{participant}/update', [ParticipantController::class, 'update']);
                Route::delete('{participant}/delete', [ParticipantController::class, 'delete']);
                Route::get('{participant}/show', [ParticipantController::class, 'show']);
            }
        );
    }
);
