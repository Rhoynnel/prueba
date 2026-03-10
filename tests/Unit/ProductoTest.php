<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('producto pertenece a una categoria y la relación funciona', function () {
    $categoriaId = DB::table('categorias')->insertGetId([
        'name' => 'Test Cat',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('productos')->insert([
        'codigo' => 'TEST',
        'nombre' => 'Test Product',
        'categorias_id' => $categoriaId,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $producto = Producto::with('categoria')->first();

    expect($producto)->not->toBeNull();
    expect($producto->categoria)->not->toBeNull();
    expect($producto->categoria->name)->toBe('Test Cat');
});
