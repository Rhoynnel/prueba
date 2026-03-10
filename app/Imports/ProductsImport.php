<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * Map each row of the spreadsheet into a Producto model (creating or updating as needed).
     *
     * The import expects the first row to contain headers such as:
     * codigo,nombre,categoria,barra,stock_actual
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // skip rows without a code or name or category
        if (empty($row['codigo']) || empty($row['nombre']) || empty($row['categoria'])) {
            return null;
        }

        // ensure category exists (firstOrCreate keeps duplicates from being added)
        $categoryName = trim($row['categoria']);
        $categoria = Categoria::firstOrCreate(['name' => $categoryName]);

        // update existing product by codigo or create new
        return Producto::updateOrCreate(
            ['codigo' => $row['codigo']],
            [
                'barra'         => $row['barra'] ?? null,
                'nombre'        => $row['nombre'],
                'stock_actual'  => isset($row['stock_actual']) ? intval($row['stock_actual']) : 0,
                'categorias_id' => $categoria->id,
            ]
        );
    }
}
