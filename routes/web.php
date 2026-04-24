<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryMovementController;

Route::get('/', function () { 
    return redirect()->route('login'); 
});

// Autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas Protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class)->only(['index', 'store', 'show', 'destroy']);
    Route::get('/movements/create', [InventoryMovementController::class, 'create'])->name('movements.create');
    Route::post('/movements', [InventoryMovementController::class, 'store'])->name('movements.store');
});
