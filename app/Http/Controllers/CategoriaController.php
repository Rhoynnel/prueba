<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function categorias(){
        $categorias = Categoria::paginate(5);
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

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($categoria);
        }

        return redirect()->route('categorias')->with('success', 'Categoria creada exitosamente.');
    }
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect()->route('categorias')->with('success', 'Categoria eliminada exitosamente.');
    }

}
