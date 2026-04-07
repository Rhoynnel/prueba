<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedores_id');
    }

    public function detalleCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'compras_id');
    }

    public function numeroCompra()
    {
        return "C-" . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
