<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Auth::routes();

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::delete('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

Route::prefix('cities')->group(
    function () {
        Route::get('/', [CityController::class, 'index'])->name('cities');
        Route::get('create', [CityController::class, 'create'])->name('cities.create');
        Route::post('store', [CityController::class, 'store'])->name('cities.store');
        Route::get('{city}/show', [CityController::class, 'show'])->name('cities.show');
        Route::get('{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
        Route::post('{city}/update', [CityController::class, 'update'])->name('cities.update');
        Route::delete('{city}/delete', [CityController::class, 'delete'])->name('cities.delete');
    }
);

Route::prefix('events')->group(
    function () {
        Route::get('/', [EventController::class, 'index'])->name('events');
        Route::get('create', [EventController::class, 'create'])->name('events.create');
        Route::post('store', [EventController::class, 'store'])->name('events.store');
        Route::get('{event}/show', [EventController::class, 'show'])->name('events.show');
        Route::get('{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::post('{event}/update', [EventController::class, 'update'])->name('events.update');
        Route::delete('{event}/delete', [EventController::class, 'delete'])->name('events.delete');
    }
);

Route::prefix('participants')->group(
    function () {
        Route::get('/', [ParticipantController::class, 'index'])->name('participants');
        Route::get('create', [ParticipantController::class, 'create'])->name('participants.create');
        Route::post('store', [ParticipantController::class, 'store'])->name('participants.store');
        Route::get('{participant}/show', [ParticipantController::class, 'show'])->name('participants.show');
        Route::get('{participant}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
        Route::post('{participant}/update', [ParticipantController::class, 'update'])->name('participants.update');
        Route::delete('{participant}/delete', [ParticipantController::class, 'delete'])->name('participants.delete');
    }
);
