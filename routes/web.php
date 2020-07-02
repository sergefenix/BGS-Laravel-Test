<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/cities', [CityController::class, 'index'])->name('cities');
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::delete('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/{event}/show', [EventController::class, 'show'])->name('events.show');
Route::delete('/events/{event}/delete', [EventController::class, 'delete'])->name('events.delete');

Route::get('participants', [ParticipantController::class, 'index'])->name('participants');
Route::get('participants/create', [ParticipantController::class, 'create'])->name('participants.create');
Route::post('participants/store', [ParticipantController::class, 'store'])->name('participants.store');
Route::get('participants/{participant}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
Route::post('participants/{participant}/update', [ParticipantController::class, 'update'])->name('participants.update');
Route::delete('participants/{participant}/delete', [ParticipantController::class, 'delete'])->name('participants.delete');
Route::get('participants/{participant}/show', [ParticipantController::class, 'show'])->name('participants.show');

//Route::get('banks/search', [ParticipantController::class, 'search'])->name('banks.search');
