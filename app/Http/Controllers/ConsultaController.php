<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Proveedor;
use App\Models\Producto;
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

    public function producto(request $request){
        $producto = Producto::where('codigo', $request->codigo)->first();
        return view('consulta.producto', compact('producto'));
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
