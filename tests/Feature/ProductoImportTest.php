<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;
use App\Models\Categoria;

it('imports products and categories from a CSV through the form', function () {
    // prepare a fake authenticated user
    $user = \App\Models\User::factory()->create();

    // build a simple CSV with header row
    $csv = <<<CSV
codigo,nombre,categoria,barra,stock_actual
P1,Producto Uno,Categoría A,12345,10
P2,Producto Dos,Categoría B,,5
CSV;

    // create a fake uploaded file
    $file = UploadedFile::fake()->createWithContent('productos.csv', $csv);

    // hit the import route
    $response = $this->actingAs($user)
        ->post(route('producto.import'), [
            'file' => $file,
        ]);

    $response->assertRedirect(route('productos'));
    $response->assertSessionHas('success');

    // check that categories and products were persisted
    $this->assertDatabaseHas('categorias', ['name' => 'Categoría A']);
    $this->assertDatabaseHas('categorias', ['name' => 'Categoría B']);
    $this->assertDatabaseHas('productos', ['codigo' => 'P1', 'nombre' => 'Producto Uno']);
    $this->assertDatabaseHas('productos', ['codigo' => 'P2', 'nombre' => 'Producto Dos']);

    // verify association
    $prod1 = Producto::where('codigo', 'P1')->first();
    expect($prod1->categoria->name)->toBe('Categoría A');

    // import again with modified name to ensure updateOrCreate works
    $csv2 = "codigo,nombre,categoria\nP1,Producto Uno Cambiado,Categoría A";
    $file2 = UploadedFile::fake()->createWithContent('productos.csv', $csv2);
    $response2 = $this->actingAs($user)
        ->post(route('producto.import'), ['file' => $file2]);
    $response2->assertSessionHas('success');
    $this->assertDatabaseHas('productos', ['codigo' => 'P1', 'nombre' => 'Producto Uno Cambiado']);
});
