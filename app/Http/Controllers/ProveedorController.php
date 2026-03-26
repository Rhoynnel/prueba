<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\DetalleCompra;

use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function proveedores()
    {
        // paginate directly on the query builder; calling all() returns a collection,
        // which does not have a paginate method and triggered the error.
        $proveedores = Proveedor::paginate(5);
        return view('proveedor.index', compact('proveedores'));
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string|max:20',
        ]);

        $cedula = $request->input('cedula');

        // 1. Buscamos el proveedor por RIF/Cédula
        $proveedor = Proveedor::where('rif', $cedula)->first();

        // Si NO existe el proveedor, redirigimos fuera de una vez
        if (!$proveedor) {
            return redirect()->route('proveedor.crear')
                ->with('error', 'No se encontró proveedor con ese Rif o cédula.');
        } else {

           // dd("Buscando compra para proveedor ID: " . $proveedor->id);
            // 2. Buscamos la compra ACTIVA (status 0) para ese proveedor
            // Importante: Asegúrate que la relación 'proveedor' esté en el modelo Compra
            $compras = Compra::where('proveedores_id', $proveedor->id)
                ->where('status', 0)
                ->with('proveedor')
                ->first();
                //dd("Compra encontrada: " . ($compras ? $compras->id : "No hay compra activa"));

            // 3. Verificamos si existe la compra antes de ir a 'cargar'
            if (!$compras) {
                //dd("No hay compra activa para este proveedor.".($proveedor ? $proveedor->nombre : "Proveedor no encontrado")." Redirigiendo a crear compra...");
                 // 4. Si llegó aquí es porque existe el proveedor pero NO tiene compras status 0
                // Usamos la variable $proveedor que ya tenemos (no hace falta buscarla de nuevo)
                $proveedores = Proveedor::where('id', $proveedor->id)->first();
                return view('compra.create', compact('proveedores'))
                    ->with('success', 'Proveedor encontrado, pero no tiene procesos de compra pendientes.');
                
            } else {
                $productos = Producto::with('categoria')->get();
                $detalleCompra = DetalleCompra::where('compras_id', $compras->id)
                    ->with('producto')
                    ->get();

                return view('compra.cargar', compact('compras', 'productos', 'detalleCompra'))
                    ->with('success', 'Compra recuperada exitosamente.');

               
            }
        }
    }

    public function create()
    {
        return view('proveedor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rif' => 'required|string|max:20|unique:proveedores,rif',
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);
        $proveedor = new Proveedor();
        $proveedor->rif = $request->input('rif');
        $proveedor->nombre = $request->input('nombre');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->save();

        $proveedores = Proveedor::find($proveedor->id)->get();

        return view('compra.create', compact('proveedores'))->with('success', 'Proveedor registrado exitosamente.');
    }
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedores')->with('success', 'Proveedor eliminado exitosamente.');
    }
    public function update(Request $request)
{
    // 1. Validación
    $request->validate([
        'id' => 'required|integer|exists:proveedores,id',
        'rif' => 'required|string|max:20',
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|string|max:20',
        'direccion' => 'required|string|max:255',
    ]);

    // 2. Localización (Cambiado param por input o el acceso directo)
    $proveedor = Proveedor::findOrFail($request->id);

    // 3. Actualización
    $proveedor->rif = $request->rif;
    $proveedor->nombre = $request->nombre;
    $proveedor->telefono = $request->telefono;
    $proveedor->direccion = $request->direccion;
    
    // Guardamos y verificamos el éxito
    if ($proveedor->save()) {
        // Traemos todos los proveedores para el select de la vista de compras
        $proveedores = Proveedor::paginate(5); 

        return view('proveedor.index', compact('proveedores'))
            ->with('success', 'Proveedor actualizado exitosamente.');
    }

    // En caso de falla inesperada al guardar
    return back()->with('error', 'No se pudieron guardar los cambios.');
}


}
