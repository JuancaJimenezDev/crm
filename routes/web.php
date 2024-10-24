<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesReportController;
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

Route::get('sales-reports', [SalesReportController::class, 'index'])->name('sales-reports.index');

// Ruta para exportar todos los encabezados y detalles a Excel
Route::get('sales-reports/export-excel', [SalesReportController::class, 'exportExcel'])->name('sales-reports.exportExcel');
Route::get('/sales-reports/exportAllPDF', [SalesReportController::class, 'exportAllPDF'])->name('sales-reports.exportAllPDF');


// Ruta para exportar una venta específica a PDF
Route::get('sales-reports/export-pdf/{id}', [SalesReportController::class, 'exportSinglePDF'])->name('sales-reports.exportSinglePDF');
// Rutas anidadas para detalle de ventas
Route::prefix('ventas/{venta}')->group(function () {
    Route::resource('detalle_ventas', DetalleVentaController::class)->except(['show']);
});

// Rutas para promociones
Route::resource('promociones', PromocionController::class)->only(['index']);
Route::post('promociones/enviar', [PromocionController::class, 'enviarPromociones'])->name('promociones.enviar');

// Rutas de autenticación
require __DIR__.'/auth.php';
