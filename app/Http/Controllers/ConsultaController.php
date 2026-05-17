<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Despacho;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function consulta(){
        return view('consulta.index');
    }

    public function cliente(request $request){
        $cliente = Cliente::where('cedula', $request->cedula)->first();
        return view('consulta.cliente', compact('cliente'));
    }

    public function proveedor(request $request){
        $proveedor = Proveedor::where('rif', $request->rif)->first();
        return view('consulta.proveedor', compact('proveedor'));
    }

    public function producto(Request $request) {
    $productos = Producto::where('codigo', $request->codigo)
        ->orWhere('barra', $request->codigo)
        ->orWhere('nombre', 'LIKE', "%{$request->codigo}%") // Te agregué el LIKE para que busque por nombre parcial
        ->with('categoria')
        ->paginate(5)
        ->withQueryString(); // <-- CAMBIADO DE first() A get()

    $categorias = Categoria::all();
    
    return view('producto.index', compact('productos', 'categorias'));
    }

    public function despacho(request $request){
        $request->validate([
            'desde' => 'required',
            'hasta' => 'required',
        ]);
        $despachos = Despacho::whereBetween('created_at', [$request->desde, $request->hasta])->get();
        return view('consulta.despacho', compact('despachos'));
    }
}
