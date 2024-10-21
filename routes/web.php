<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PromocionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de recursos
Route::resource('clientes', ClienteController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('inventario', InventoryController::class);  // Cambié 'inventario' a 'inventarios' para mantener consistencia plural
Route::resource('pagos', PagoController::class);
Route::resource('ventas', VentaController::class);

// Rutas anidadas para detalle de ventas
Route::prefix('ventas/{venta}')->group(function () {
    Route::resource('detalle_ventas', DetalleVentaController::class)->except(['show']);
    Route::resource('export', VentaController::class)->except(['show']);
});

// Rutas para promociones
Route::resource('promociones', PromocionController::class)->only(['index']);
Route::post('promociones/enviar', [PromocionController::class, 'enviarPromociones'])->name('promociones.enviar');

// Rutas de autenticación
require __DIR__.'/auth.php';
