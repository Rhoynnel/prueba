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
        // paginate on query builder instead of after retrieving all records
        $clientes = Cliente::paginate(5);
        return view('cliente.index',compact('clientes'));
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
            'nombreCompleto' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'origen' => 'required|string|max:255',

        ]);

        $cliente = new Cliente();
        $cliente->cedula = $request->input('cedula');
        $cliente->nombreCompleto = $request->input('nombreCompleto');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->save();

               
        if($request->input('origen') == 'Despacho'){
            $cliente= Cliente::where('cedula', $request->input('cedula'))->first();
            $tasaVigente= Tasa::orderBy('fecha', 'desc')->first();
            return view('despacho.create',compact('cliente', 'tasaVigente'))->with('success', 'Cliente creado exitosamente.');
        }else{
            $clientes= Cliente::paginate(5);
            return view('cliente.index',compact('clientes'))->with('success', 'Cliente creado exitosamente.');
        }

    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes')->with('success', 'Cliente eliminado exitosamente.');
    }

    public function update(Request $request)
    {
        // 1. Validar ignorando el ID actual en la regla unique
        $request->validate([
            'id' => 'required|integer|exists:clientes,id',
            'cedula' => 'required|unique:clientes,cedula,' . $request->id, // <--- CAMBIO AQUÍ
            'nombreCompleto' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        $cliente = Cliente::findOrFail($request->id);
        $cliente->cedula = $request->cedula;
        $cliente->nombreCompleto = $request->nombreCompleto;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;

        if($cliente->save()){
            // 2. RECOMENDACIÓN: Usa redirect en lugar de view para evitar problemas de reenvío
            return redirect()->route('clientes')->with('success', 'Cliente actualizado exitosamente.');
        } else {
            return back()->with('error', 'No se pudieron guardar los cambios.');
        }
    }
        
}
