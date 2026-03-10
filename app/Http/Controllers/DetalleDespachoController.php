<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleDespacho;

class DetalleDespachoController extends Controller
{
    public function salidas(){
        $salidas = DetalleDespacho::all();
        return view('salidas',compact('salidas'));
    }
    public function crear(){
        return view('salida.crear');
    }

    public function store(Request $request){
        $request->validate([
            'clientes_id' => 'required|exists:clientes,id',
            'productos_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $salida = new DetalleDespacho();
        $salida->clientes_id = $request->input('clientes_id');
        $salida->productos_id = $request->input('productos_id');
        $salida->cantidad = $request->input('cantidad');
        $salida->save();

        return redirect()->route('salidas')->with('success', 'Salida creada exitosamente.');
    }   
}
