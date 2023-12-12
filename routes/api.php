<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/historias','App\Http\Controllers\HistoriaController@index');
Route::get('/historias/{id}','App\Http\Controllers\HistoriaController@mostrarHistoria');
Route::post('/historias','App\Http\Controllers\HistoriaController@crearHistoria');
Route::put('/historias/{id}','App\Http\Controllers\HistoriaController@actualizarHistoria');
Route::delete('/historias/{id}','App\Http\Controllers\HistoriaController@borrarHistoria');


Route::get('/usuarios','App\Http\Controllers\UserController@index');


Route::controller(UserController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});
