<?php

use App\Http\Controllers\AdressController;
use App\Http\Controllers\UserController;
use App\Models\Adress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
Route::post('/user', [UserController::class, 'store'])->name('user.store');


Route::post('/adress', [AdressController::class, 'store'])->name('adress.store');
Route::put('/adress/{adress}', [AdressController::class, 'update'])->name('update.show');