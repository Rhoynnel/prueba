<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function productos(){
        $productos = Producto::join('categorias', 'productos.categorias_id', '=', 'categorias.id')// Hacemos un join con la tabla categorías para poder ordenar por el nombre de la categoría
        ->orderBy('categorias.name', 'asc') // Ordenamos por el nombre de la categoría
        ->with('categoria') // Cargamos la relación para tener el objeto categoría disponible
        ->paginate(5); // Paginación de 5 productos por página
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
        'categoriaid' => 'required|exists:categorias,id',
    ]);

        $producto= new Producto();
        $producto->codigo=$request->input('codigo');
        $producto->barra=$request->input('barra');
        $producto->nombre=$request->input('nombre');
        $producto->categorias_id=$request->input('categoriaid');
        $producto->save();


        return redirect()->route('producto.index')->with('success', 'Producto creado exitosamente.');
    }
}
