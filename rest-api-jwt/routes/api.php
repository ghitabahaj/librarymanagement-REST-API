<?php

use Illuminate\Http\Request;
use App\Http\Controllers\assignRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LivreController;

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
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

Route::resource('Livre',LivreController::class);
Route::resource('Genre',GenreController::class);
Route::resource('User',UserController::class);
Route::post('assignRole/{user_id}',[assignRole::class , 'asignRole'])->middleware(['can:assign role']);
Route::post('asignPerToRole/{role_id}',[assignRole::class , 'asignPerToRole']);
Route::delete('removeRole/{user_id}',[assignRole::class , 'removeRole']);




