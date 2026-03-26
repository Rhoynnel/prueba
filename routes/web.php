<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DespachoController;
use App\Http\Controllers\TasaController;
use App\Http\Controllers\ProveedorController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
/*
Route::get('/producto.crear', function () {
    return view('producto.crear');
})->middleware(['auth', 'verified'])->name('producto.crear');
*/
Route::get('/productos', [ProductoController::class, 'productos'])->middleware(['auth', 'verified'])->name('productos');
Route::post('/productos', [ProductoController::class, 'store'])->middleware(['auth', 'verified'])->name('producto.store');
Route::put('/producto{id}', [ProductoController::class, 'update'])->middleware(['auth', 'verified'])->name('producto.update');
route::delete('/producto{id}',[ProductoController::class, 'destroy'])->middleware(['auth', 'verified'])->name('producto.destroy');
Route::get('/producto.crear', [ProductoController::class, 'create'])->middleware(['auth', 'verified'])->name('producto.crear');

Route::get('/categorias', [CategoriaController::class, 'categorias'])->middleware(['auth', 'verified'])->name('categorias');
Route::post('/categorias', [CategoriaController::class, 'store'])->middleware(['auth', 'verified'])->name('categoria.store');
Route::get('/categoria.crear', [CategoriaController::class, 'create'])->middleware(['auth', 'verified'])->name('categoria.crear');

route::get('/despachos', [DespachoController::class, 'despachos'])->middleware(['auth', 'verified'])->name('despachos');
route::post('/despachos', [DespachoController::class, 'store'])->middleware(['auth', 'verified'])->name('despacho.store');
route::get('/despacho.crear', [DespachoController::class, 'create'])->middleware(['auth', 'verified'])->name('despacho.crear');
route::get('/despacho.cargar', [DespachoController::class, 'cargar'])->middleware(['auth', 'verified'])->name('despacho.cargar');
route::post('/despacho.agregarProducto', [DespachoController::class, 'agregarProducto'])->middleware(['auth', 'verified'])->name('despacho.agregarProducto');
route::delete('/despacho.detalle/{id}', [DespachoController::class, 'destroyDetalle'])->middleware(['auth', 'verified'])->name('despacho.destroyDetalle');
route::put('/despacho.cambiarStatus/{id}', [DespachoController::class, 'cambiarStatus'])->middleware(['auth', 'verified'])->name('despacho.cambiarStatus');

route::get('/compras', [CompraController::class, 'compras'])->middleware(['auth', 'verified'])->name('compras');
route::post('/compra.crear', [CompraController::class, 'create'])->middleware(['auth', 'verified'])->name('compra.crear');
route::get('/compra.cargar', [CompraController::class, 'cargar'])->middleware(['auth', 'verified'])->name('compra.cargar');
route::post('/compras', [CompraController::class, 'store'])->middleware(['auth', 'verified'])->name('compra.store');
route::post('/compra.agregarProducto', [CompraController::class, 'agregarProducto'])->middleware(['auth', 'verified'])->name('compra.agregarProducto');
route::delete('/compra.detalle/{id}', [CompraController::class, 'destroyDetalle'])->middleware(['auth', 'verified'])->name('compra.destroyDetalle');
route::put('/compra.cambiarStatus/{id}', [CompraController::class, 'cambiarStatus'])->middleware(['auth', 'verified'])->name('compra.cambiarStatus');

route::get('/clientes', [ClienteController::class, 'clientes'])->middleware(['auth', 'verified'])->name('clientes');
route::post('/clientes', [ClienteController::class, 'store'])->middleware(['auth', 'verified'])->name('cliente.store');
route::put('/cliente{id}',[ClienteController::class, 'update'])->middleware(['auth', 'verified'])->name('cliente.update');
route::delete('/cliente{id}',[ClienteController::class, 'destroy'])->middleware(['auth', 'verified'])->name('cliente.destroy');
route::get('/cliente.crear', [ClienteController::class, 'create'])->middleware(['auth', 'verified'])->name('cliente.crear');
route::get('/cliente.buscar', [ClienteController::class, 'buscar'])->middleware(['auth', 'verified'])->name('cliente.buscar');

Route::get('/tasas', [TasaController::class, 'index'])->middleware(['auth', 'verified'])->name('tasas');
Route::get('/tasa.crear', [TasaController::class, 'create'])->middleware(['auth', 'verified'])->name('tasa.crear');
Route::post('/tasas', [TasaController::class, 'store'])->middleware(['auth', 'verified'])->name('tasa.store');

// import products and categories from Excel/CSV
Route::post('/productos/import', [\App\Http\Controllers\ProductoController::class, 'import'])
    ->middleware(['auth','verified'])
    ->name('producto.import');
Route::delete('/tasas/{id}', [TasaController::class, 'destroy'])->middleware(['auth', 'verified'])->name('tasa.destroy');

route::get('/proveedores', [ProveedorController::class, 'proveedores'])->middleware(['auth', 'verified'])->name('proveedores');
route::post('/proveedores', [ProveedorController::class, 'store'])->middleware(['auth', 'verified'])->name('proveedor.store');
Route::put('/proveedor{id}', [ProveedorController::class, 'update'])->middleware(['auth', 'verified'])->name('proveedor.update');
Route::delete('/proveedor{id}',[ProveedorController::class, 'destroy'])->middleware(['auth', 'verified'])->name('proveedor.destroy');


route::get('/proveedor.crear', [ProveedorController::class, 'create'])->middleware(['auth', 'verified'])->name('proveedor.crear');
route::get('/proveedor.buscar', [ProveedorController::class, 'buscar'])->middleware(['auth', 'verified'])->name('proveedor.buscar');

// user management CRUD
Route::get('/usuarios', [\App\Http\Controllers\UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('usuarios');
Route::get('/usuario.crear', [\App\Http\Controllers\UserController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('usuario.crear');
Route::post('/usuarios', [\App\Http\Controllers\UserController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('usuario.store');
Route::get('/usuario/{user}/editar', [\App\Http\Controllers\UserController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('usuario.edit');
Route::put('/usuario/{user}', [\App\Http\Controllers\UserController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('usuario.update');
Route::delete('/usuario/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('usuario.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
