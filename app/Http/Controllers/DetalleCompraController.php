<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleCompra;

class DetalleCompraController extends Controller
{
    public function entradas(){
        $entradas = DetalleCompra::all();
        return view('entradas',compact('entradas'));
    }
    public function crear(){
        return view('entrada.crear');
    }

    public function store(Request $request){
        $request->validate([
            'productos_codigo' => 'required|exists:productos,codigo',
            'cantidad' => 'required|integer|min:1',
            
        ]);

        $entrada = new DetalleCompra();
        $entrada->productos_codigo = $request->input('productos_codigo');
        $entrada->cantidad = $request->input('cantidad');
        $entrada->save();

        return redirect()->route('entrada.crear')->with('success', 'Entrada creada exitosamente.');
    }   
}
