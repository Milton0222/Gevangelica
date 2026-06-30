<?php

use App\Http\Controllers\membroController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ContribuicaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    alert()->success('Welcome to the application!');
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ===========================
    // ROTAS DE MEMBROS
    // ===========================
    Route::resource('membros', membroController::class, [
        'names' => [
            'index' => 'membro.index',
            'create' => 'membro.create',
            'store' => 'membro.store',
            'show' => 'membro.show',
            'edit' => 'membro.edit',
            'update' => 'membro.update',
            'destroy' => 'membro.destroy',
        ]
    ]);

    // ===========================
    // ROTAS DE USUÁRIOS
    // ===========================
    Route::resource('usuarios', userController::class, [
        'names' => [
            'index' => 'usuario.index',
            'create' => 'usuario.create',
            'store' => 'usuario.store',
            'show' => 'usuario.show',
            'edit' => 'usuario.edit',
            'update' => 'usuario.update',
            'destroy' => 'usuario.destroy',
        ]
    ]);

    Route::get('usuarios/desabilitar/{id}', [userController::class, 'desabilitar'])
        ->name('usuario.desabilitar');

    // ===========================
    // ROTAS DE CLASSES
    // ===========================
    Route::resource('classes', ClasseController::class, [
        'names' => [
            'index' => 'classe.index',
            'create' => 'classe.create',
            'store' => 'classe.store',
            'show' => 'classe.show',
            'edit' => 'classe.edit',
            'update' => 'classe.update',
            'destroy' => 'classe.destroy',
        ]
    ]);

    // ===========================
    // ROTAS DE DEPARTAMENTOS
    // ===========================
    Route::resource('departamentos', DepartamentoController::class, [
        'names' => [
            'index' => 'departamento.index',
            'create' => 'departamento.create',
            'store' => 'departamento.store',
            'show' => 'departamento.show',
            'edit' => 'departamento.edit',
            'update' => 'departamento.update',
            'destroy' => 'departamento.destroy',
        ]
    ]);

    // ===========================
    // ROTAS DE EVENTOS
    // ===========================
    Route::resource('eventos', EventoController::class, [
        'names' => [
            'index' => 'evento.index',
            'create' => 'evento.create',
            'store' => 'evento.store',
            'show' => 'evento.show',
            'edit' => 'evento.edit',
            'update' => 'evento.update',
            'destroy' => 'evento.destroy',
        ]
    ]);

    // ===========================
    // ROTAS DE SALAS
    // ===========================
    Route::resource('salas', SalaController::class, [
        'names' => [
            'index' => 'sala.index',
            'create' => 'sala.create',
            'store' => 'sala.store',
            'show' => 'sala.show',
            'edit' => 'sala.edit',
            'update' => 'sala.update',
            'destroy' => 'sala.destroy',
        ]
    ]);

    // ===========================
    // ROTAS DE CONTRIBUIÇÕES
    // ===========================
    Route::resource('contribuicoes', ContribuicaoController::class, [
        'names' => [
            'index' => 'contribuicao.index',
            'create' => 'contribuicao.create',
            'store' => 'contribuicao.store',
            'show' => 'contribuicao.show',
            'edit' => 'contribuicao.edit',
            'update' => 'contribuicao.update',
            'destroy' => 'contribuicao.destroy',
        ]
    ]);
});
