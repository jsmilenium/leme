<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return 'home';
})->name('home');

Route::get('profile', function () {
    return 'profile';
})->name('profile');

Route::get('page', function () {
    return 'page';
})->name('page');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::middleware(['auth'])->group(function () {
    Route::get('cliente', function () {
        return view('pages.clientes.create');
    })->name('cliente');
    Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get('/cliente/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
    Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');

    Route::get('/pedido', [PedidoController::class, 'create'])->name('pedido.create');
    Route::post('/pedido', [PedidoController::class, 'store'])->name('pedido.store');
    Route::get('/pedido/{id}', [PedidoController::class, 'edit'])->name('pedido.edit');
    Route::put('/pedido/{id}', [PedidoController::class, 'update'])->name('pedido.update');
    Route::delete('/pedido/{id}', [PedidoController::class, 'destroy'])->name('pedido.destroy');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.index');
});
