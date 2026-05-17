<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ProductsImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * Map each row of the spreadsheet into a Producto model (creating or updating as needed).
     *
     * The import expects the first row to contain headers such as:
     * codigo,nombre,categoria,barra,stock_actual
     *
     * @param Collection $rows
     */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $rowData = $row->toArray();
        
        // Extraemos los valores (limpiando espacios si son cadenas)
        $codigo   = isset($rowData['codigo']) ? trim($rowData['codigo']) : '';
        $nombre   = isset($rowData['nombre']) ? trim($rowData['nombre']) : '';
        $catName  = isset($rowData['categoria']) ? trim($rowData['categoria']) : '';
        
        $stock    = $rowData['stock_actual'] ?? null;
        $precio_venta = $rowData['precio_venta'] ?? null;
        $precio_compra = $rowData['precio_compra'] ?? null;

        // CORRECCIÓN: Validamos que no sean nulos o cadenas vacías. 
        // Permitimos el número 0 como precio o stock válido.
        if ($codigo === '' || $nombre === '' || $catName === '' || $stock === null || $precio_venta === null || $precio_compra === null) {
            continue; 
        }

        // Buscar o crear la categoría
        $categoria = Categoria::firstOrCreate(['name' => $catName]);

        // Guardar o actualizar producto
        Producto::updateOrCreate(
            ['codigo' => $codigo],
            [
                'barra'         => $rowData['barra'] ?? null,
                'nombre'        => $nombre,
                'stock_actual'  => intval($stock),
                'categorias_id' => $categoria->id,
                'precio_venta'  => floatval($precio_venta),
                'precio_compra' => floatval($precio_compra),
            ]
        );
        }   
    }
    
    public function chunkSize(): int{
        return 4000;
    }
    
}
