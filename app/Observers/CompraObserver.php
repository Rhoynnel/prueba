<?php

namespace App\Observers;

use App\Models\Compra;
use Illuminate\Support\Facades\DB;

class CompraObserver
{
    public function updated(Compra $compra)
    {
        // Solo actuamos si el estado cambió a 'Recibido'
        if ($compra->wasChanged('status') && $compra->status === 1) {
            
            DB::transaction(function () use ($compra) {
                foreach ($compra->detalleCompra as $detalle) {
                    $producto = $detalle->producto;

                    if ($producto) {
                        // INCREMENTAMOS el stock actual
                        $producto->increment('stock_actual', $detalle->cantidad);
                        
                        // Opcional: Actualizar el precio de compra del producto 
                        // basado en la última compra
                        /*$producto->update([
                            'precio_compra' => $detalle->precio_unitario
                        ]);*/
                    }
                }
            });
        }
    }
}
