<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,CanalController,NotificacoesController,UsuarioController,UsuarioHasCanalController};

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

Route::get('initialize', [CanalController::class, 'initialize']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/cadastrar', [UsuarioController::class, 'cadastrar']);

Route::group(['middleware' => ['auth:sanctum', 'throttle:5000,1']], function () {
    Route::get('dados-usuario', [UsuarioController::class, 'dadosUsuario']);
    Route::post('atualizar-informacoes', [UsuarioController::class, 'atualizarInformacoes']);
    Route::post('validar-email', [UsuarioController::class, 'validarEmail']);

    Route::post('acao-canal', [UsuarioHasCanalController::class, 'acaoCanal']);

    Route::resource('notificacoes', NotificacoesController::class);

    Route::get('initialize-usuario', [CanalController::class, 'initialize']);

    Route::get('logout', [AuthController::class, 'logout']);
});
