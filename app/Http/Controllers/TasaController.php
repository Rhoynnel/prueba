<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasa;

class TasaController extends Controller
{
    public function index()
    {
        $tasas = Tasa::orderBy('fecha', 'desc')->paginate(5);
        return view('tasa.index', compact('tasas'));
    }

    public function create()
    {
        return view('tasa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tasa' => 'required|numeric',
        ]);
        $fecha=date('Y-m-d');

        $tasa = new Tasa();
        $tasa->tasa = $request->input('tasa');
        $tasa->fecha = $fecha;
        $tasa->save();

        return redirect()->route('tasas')->with('success', 'Tasa creada exitosamente.');
    }

    public function destroy($id)
    {
        $tasa = Tasa::findOrFail($id);
        $tasa->delete();

        return redirect()->route('tasas')->with('success', 'Tasa eliminada exitosamente.');
    }
}
