<?php

namespace App\Observers;
use App\Models\Despacho;
use Illuminate\Support\Facades\DB;

class DespachoObserver
{
    public function updated(Despacho $despacho)
    {
        // Solo actuamos si el estado cambió a 'Despachado'
        if ($despacho->wasChanged('status') && $despacho->status === 1) {

            DB::transaction(function () use ($despacho) {
            
            foreach ($despacho->detalleDespacho as $detalle) {
                $producto = $detalle->producto;

                if ($producto) {
                    // DECREMENTAMOS el stock actual
                    $producto->decrement('stock_actual', $detalle->cantidad);
                }
            }
            });
        }
        
    }
    
}
