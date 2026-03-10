<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Despacho;
use App\Models\DetalleDespacho;
use App\Models\Tasa;
use App\Models\Producto;

class ClienteController extends Controller
{
    public function clientes(){
        $clientes = Cliente::all();
        return view('clientes',compact('clientes'));
    }
    public function create(){
        return view('cliente.create');
    }

    public function buscar(Request $request){
        $cedula = $request->input('cedula');
        $cliente = Cliente::where('cedula', $cedula)->first();

        if (!$cliente) {
            return redirect()->route('cliente.crear')->with('cedula', $cedula)->with('error', 'No se encontró cliente con esa cédula. Por favor, créalo primero.');
            
        } else {
            $despachoActivo = Despacho::where('clientes_id', $cliente->id)->where('status', 0)->with('cliente', 'tasa')->first();
            if(!$despachoActivo){
                $tasaVigente = Tasa::orderBy('fecha', 'desc')->first();
                //dd ("Cliente encontrado, pero no tiene despachos activos. Redirigiendo a crear despacho...".($cliente ? $cliente->nombreCompleto : "Cliente no encontrado")." Tasa vigente: ".($tasaVigente ? $tasaVigente->tasa : "No hay tasa vigente"));
                return view('despacho.create',compact('cliente', 'tasaVigente'))->with('success', 'Cliente encontrado. Puedes proceder a crear un Despacho.');
            }else{
                $detalleDespacho = DetalleDespacho::where('despachos_id', $despachoActivo->id)->with('producto')->get();
                $productos = Producto::where('stock_actual', '>', 0)->with('categoria')->get();
            return view('despacho.cargar', compact('productos', 'despachoActivo', 'detalleDespacho'))->with('success', 'Cliente encontrado. Puedes proceder a crear un Despacho.');
            }
        }
    }

    public function store(Request $request){
        $request->validate([
            'cedula' => 'required|unique:clientes',
            'nombreCompleto' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',

        ]);

        $cliente = new Cliente();
        $cliente->cedula = $request->input('cedula');
        $cliente->nombreCompleto = $request->input('nombreCompleto');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->save();

        $cliente= Cliente::where('cedula', $request->input('cedula'))->first();
        $tasaVigente= Tasa::orderBy('fecha', 'desc')->first();
        


        return view('despacho.create',compact('cliente', 'tasaVigente'))->with('success', 'Cliente creado exitosamente.');
    }
}
