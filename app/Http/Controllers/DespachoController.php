<?php

namespace App\Http\Controllers;

use App\Models\Despacho;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Tasa;
use App\Models\DetalleDespacho;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DespachoController extends Controller
{
    public function despachos(){
        $despachos = Despacho::with('cliente', 'tasa')->withsum('detalleDespacho as total_dolares','precio_dolar')->withsum('detalleDespacho as total_bs','precio_bs')->orderBy('id', 'desc')
        ->paginate(5);
        return view('despacho.index',compact('despachos'));
    }

    public function create(){
        return view('despacho.create');
    }

    public function store(Request $request){
        $request->validate([
            'clientes_id' => 'required',
            'tasa_id' => 'required',
        ]);

        $despacho = new Despacho();
        $despacho->clientes_id = $request->input('clientes_id');
        $despacho->tasas_id = $request->input('tasa_id');
        $despacho->save();

        $despachoDetalle = Despacho::where('id', $despacho->id)->with('cliente', 'tasa')->first();

        return redirect()->route('despacho.cargar',compact('despachoDetalle'))->with('success', 'Despacho creado exitosamente.');

    }

    public function cargar(Request $request){
        $request->validate([
            'clientes_id' => 'required|integer|exists:clientes,id',
        ]);

        $despachoActivo = Despacho::where('status', 0)->where('clientes_id', $request->input('clientes_id'))->with('cliente')->first();
        $productos = Producto::with('categoria')->get();
        return view('despacho.cargar', compact('despachoActivo', 'productos'));
    }

    public function agregarProducto(Request $request){
        $request->validate([
            'despachos_id' => 'required|integer|exists:despachos,id',
            'productos_id' => 'required|integer|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $despacho = Despacho::where('id', $request->input('despachos_id'))->first();

        if (!$despacho) {
            return redirect()->back()->with('error', 'Despacho no encontrado.');
        }

        $producto= Producto::find($request->input('productos_id'));

        $tasaDespacho = $despacho->tasa ? $despacho->tasa->tasa : null;
        if ($tasaDespacho === null) {
            $precioBolivar=0;
        } else {
            $precioBolivar = $tasaDespacho * $producto->precio_bs;
        }
        
        $cargarProducto= new DetalleDespacho();
        $cargarProducto->despachos_id = $request->input('despachos_id');
        $cargarProducto->productos_id = $request->input('productos_id');
        $cargarProducto->cantidad = $request->input('cantidad');
        $cargarProducto->precio_dolar = $producto->precio_venta;
        $cargarProducto->precio_bs = $precioBolivar;
        $cargarProducto->save();

        $despachoActivo = Despacho::find($request->input('despachos_id'))->with('cliente', 'tasa')->first();
        $productos = Producto::where('stock_actual', '>', 0)->with('categoria')->get();
        $detalleDespacho = DetalleDespacho::where('despachos_id', $request->input('despachos_id'))->with('producto')->get();
        return redirect()->route('despacho.cargar', compact('despachoActivo', 'productos', 'detalleDespacho'))->with('success', 'Producto agregado al despacho exitosamente.');

    }

    public function destroyDetalle($id)
    {
        $cargarProducto = DetalleDespacho::findOrFail($id);
        $despacho_id = $cargarProducto->despachos_id;
        $cargarProducto->delete();

        $despachoActivo = Despacho::find($despacho_id)->with('cliente', 'tasa')->first();
        $productos = Producto::where('stock_actual', '>', 0)->with('categoria')->get();
        $detalleDespacho = DetalleDespacho::where('despachos_id', $despacho_id)->with('producto')->get();
        return redirect()->route('despacho.cargar', compact('despachoActivo', 'productos', 'detalleDespacho'))->with('success', 'Producto eliminado del despacho exitosamente.');
    }

    public function cambiarStatus($id)
    {
        $despacho = Despacho::findOrFail($id);
        $despacho->status = 1; // Cambiamos el status a 1 (completado)
        $despacho->save();

        return redirect()->route('despachos')->with('success', 'Despacho completado exitosamente.');
    }

    public function generarPdf($id)
    {
        $despacho = Despacho::with('cliente', 'tasa')->withsum('detalleDespacho as total_dolares','precio_dolar')->withsum('detalleDespacho as total_bs','precio_bs')->find($id);
        $detalleDespacho = DetalleDespacho::where('despachos_id', $id)->with('producto')->get();
        $pdf = Pdf::loadView('pdf.despacho', compact('despacho', 'detalleDespacho'));
        return $pdf->download('despacho-'.$id.'.pdf');
    }
}
