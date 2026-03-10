<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\detalleCompra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function compras(){
        $compras = Compra::with('proveedor')->paginate(5);
        return view('compra.index',compact('compras'));
    }

    public function create(){
        return view('compra.create');
    }

    public function store(Request $request){

        $request->validate([
            'proveedores_id' => 'required|integer|exists:proveedores,id',
            'numero_factura' => 'required|string|max:255',
            'fecha' => 'required|date',
            
        ]);

        $compras = Compra::where('proveedores_id', $request->input('proveedores_id'))->where('status', 0)->with('proveedor')->first();
        
        if ($compras) {
            return redirect()->route('compra.cargar', compact('compras'))->with('error', 'Ya existe una compra sin cargar para este proveedor.');
        }else{
            //$compras = 0;
        

            //$fecha=date('Y-m-d');
            $compra = new Compra();
            $compra->proveedores_id = $request->input('proveedores_id');
            $compra->numero_factura = $request->input('numero_factura');
            $compra->fecha = $request->input('fecha');
            $compra->save();

            $compras = Compra::find($compra->id)->with('proveedor')->get();
            $productos = Producto::with('categoria')->get();

            return redirect()->route('compra.cargar', compact('compras', 'productos'))->with('success', 'Compra registrada exitosamente.');
        }
    }

    public function cargar(Request $request){
        $request->validate([
            'proveedores_id' => 'required|integer|exists:proveedores,id',
        ]);

        $compras = Compra::where('status', 0)->where('proveedores_id', $request->input('proveedores_id'))->with('proveedor')->first();
        $productos = Producto::with('categoria')->get();
        return view('compra.cargar', compact('compras', 'productos'));
    }

    public function agregarProducto(Request $request){
        $request->validate([
            'compra_id' => 'required|integer|exists:compras,id',
            'producto_id' => 'required|integer|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);
        $cargarProducto= new DetalleCompra();
        $cargarProducto->compras_id = $request->input('compra_id');
        $cargarProducto->productos_id = $request->input('producto_id');
        $cargarProducto->cantidad = $request->input('cantidad');
        $cargarProducto->save();

        $compras = Compra::find($request->input('compra_id'))->with('proveedor')->first();
        $productos = Producto::with('categoria')->get();
        $detalleCompra = DetalleCompra::where('compras_id', $request->input('compra_id'))->with('producto')->get();
        return redirect()->route('compra.cargar', compact('compras', 'productos', 'detalleCompra'))->with('success', 'Producto agregado a la compra exitosamente.');

    }

    public function destroyDetalle($id)
    {
        $cargarProducto = DetalleCompra::findOrFail($id);
        $compra_id = $cargarProducto->compras_id;
        $cargarProducto->delete();

        $compras = Compra::find($compra_id)->with('proveedor')->get();
        $productos = Producto::with('categoria')->get();
        $detalleCompra = DetalleCompra::where('compras_id', $compra_id)->with('producto')->get();
        return redirect()->route('compra.cargar', compact('compras', 'productos', 'detalleCompra'))->with('success', 'Producto eliminado de la compra exitosamente.');
    }

    public function cambiarStatus($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->status = 1; // Cambiamos el status a 1 (completada)
        $compra->save();

        return redirect()->route('compras')->with('success', 'Compra completada exitosamente.');
    }

    
}
