<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function categorias(){
        $categorias = Categoria::all();
        return view('categoria.index',compact('categorias'));
    }
    public function create(){
        return view('categoria.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categoria = new Categoria();
        $categoria->name = $request->input('name');
        $categoria->save();

        return redirect()->route('producto.crear')->with('success', 'Categoria creada exitosamente.');
    }
}
