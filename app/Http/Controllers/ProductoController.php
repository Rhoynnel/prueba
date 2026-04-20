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

        $productos = Producto::with('categoria')->orderBy('categorias_id', 'desc')->paginate(5);
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
        'precio_venta' => 'required|numeric',
        'precio_compra' => 'required|numeric',
    ]);

        $producto= new Producto();
        $producto->codigo=$request->input('codigo');
        $producto->barra=$request->input('barra');
        $producto->nombre=$request->input('nombre');
        $producto->stock_actual=$request->input('stock_actual');
        $producto->categorias_id=$request->input('categoriaid');
        $producto->precio_venta=$request->input('precio_venta');
        $producto->precio_compra=$request->input('precio_compra');
        $producto->save();


        return redirect()->route('productos')->with('success', 'Producto creado exitosamente.');
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

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos')->with('success', 'Producto eliminado exitosamente.');
    }

    public function update(Request $request)
    {
        // 1. Validar los datos
        $request->validate([
            'id_producto_edit' => 'required|exists:productos,id',
            'codigo' => 'required|unique:productos,codigo,' . $request->id_producto_edit,
            'barra' => 'nullable|unique:productos,barra,' . $request->id_producto_edit,
            'nombre' => 'required',
            'stock_actual' => 'required|integer|min:0',
            'categorias_id' => 'required|exists:categorias,id',
            'precio_venta' => 'required|numeric',
            'precio_compra' => 'required|numeric',
        ]);

        
            // 2. Encontrar el producto
            $producto = Producto::findOrFail($request->id_producto_edit);

            // 3. Asignar valores (Verifica que los nombres de la derecha coincidan con tu DB)
            $producto->codigo = $request->codigo;
            $producto->barra = $request->barra;
            $producto->nombre = $request->nombre;
            $producto->stock_actual = $request->stock_actual;
            $producto->categorias_id = $request->categorias_id; // <-- REVISA ESTE NOMBRE
            $producto->precio_venta = $request->precio_venta;
            $producto->precio_compra = $request->precio_compra;

            // 4. Guardar
            if($producto->save()){
                // Es mejor redireccionar que retornar la vista directamente para evitar re-envíos de formulario
                return redirect()->route('productos')->with('success', 'Producto actualizado exitosamente.');
            }else{
                return redirect()->back()->with('error', 'No se pudo guardar el producto.');
            }
    
    }
}
