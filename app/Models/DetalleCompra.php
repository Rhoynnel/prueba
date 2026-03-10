<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $table= 'detalle_compra';

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compras_id');
    }

}
