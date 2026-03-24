<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('menu', [MenuController::class, 'index'])->name('menu');
    
    // Rutas para Productos
    Route::get('productos', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('productos/crear', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('productos', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    
    // Rutas Fetch API
    Route::post('categorias/crear', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.api.store');
    Route::post('distribuidores/crear', [App\Http\Controllers\DistributorController::class, 'store'])->name('distributors.api.store');
});
