<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ProductoController extends Controller
{
    public function productos(){
        $productos = Producto::join('categorias', 'productos.categorias_id', '=', 'categorias.id')// Hacemos un join con la tabla categorías para poder ordenar por el nombre de la categoría
        ->orderBy('categorias.name', 'asc') // Ordenamos por el nombre de la categoría
        ->with('categoria') // Cargamos la relación para tener el objeto categoría disponible
        ->paginate(5); // Paginación de 5 productos por página
        $categorias= Categoria::all();
        
        //Producto:: with('categoria')->paginate(5);
        return view('producto.index',compact('productos','categorias'));
    }
    public function create(){
        $categorias = Categoria::all();
        return view('producto.create',compact('categorias'));
    }
    public function store(Request $request){
        $request->validate([
        'codigo'      => 'required|unique:productos',
        'barra'       => 'nullable|unique:productos', // Corregido: minúsculas y un solo ":"
        'nombre'      => 'required',
        'stock_actual' => 'required|integer|min:0',
        'categoriaid' => 'required|exists:categorias,id',
    ]);

        $producto= new Producto();
        $producto->codigo=$request->input('codigo');
        $producto->barra=$request->input('barra');
        $producto->nombre=$request->input('nombre');
        $producto->stock_actual=$request->input('stock_actual');
        $producto->categorias_id=$request->input('categoriaid');
        $producto->save();


        return redirect()->route('producto')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Handle bulk import of products (and their categories) from a spreadsheet.
     *
     * The uploaded file may be XLSX, CSV or ODS and must include a header row
     * with at least the columns `codigo`, `nombre` and `categoria`. Additional
     * fields such as `barra` or `stock_actual` are optional.  A category that
     * does not yet exist will be created automatically. Existing products are
     * updated by matching on the `codigo` column.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,ods',
        ]);

        // intentamos importar y manejar cualquier error que ocurra durante el proceso
        try {
            Excel::import(new ProductsImport, $request->file('file'));
        } catch (\Throwable $e) {
            return redirect()
                        ->route('productos')
                        ->with('error', 'Error en la importación: ' . $e->getMessage());
        }

        return redirect()
                    ->route('productos')
                    ->with('success', 'Importación completada con éxito.');
    }
}
