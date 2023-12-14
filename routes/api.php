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

Route::post('/historias','App\Http\Controllers\HistoriaController@crearHistoria');
Route::put('/historias/{id}','App\Http\Controllers\HistoriaController@actualizarHistoria');
Route::delete('/historias/{id}','App\Http\Controllers\HistoriaController@borrarHistoria');

Route::get('/historias/{id}','App\Http\Controllers\HistoriaController@mostrarHistoria');
Route::put('/marcar/{id}','App\Http\Controllers\HistoriaController@marcarHistoria');


Route::get('/usuarios','App\Http\Controllers\UserController@index');
Route::get('/usuarios/{id}','App\Http\Controllers\UserController@mostrarUsuario');
Route::get('/pacientes','App\Http\Controllers\UserController@listaPacientes');

Route::put('/actualizar/{id}','App\Http\Controllers\UserController@updateUser');
Route::put('/password/{id}','App\Http\Controllers\UserController@password');

Route::middleware('auth:sanctum')->get('/historias','App\Http\Controllers\HistoriaController@index');
Route::middleware('auth:sanctum')->get('/verhistorias/{id}','App\Http\Controllers\HistoriaController@mostrarHistorias');
Route::middleware('auth:sanctum')->get('/verhistoriaspaciente/{id}','App\Http\Controllers\HistoriaController@mostrarHistoriasPaciente');

Route::controller(UserController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});
