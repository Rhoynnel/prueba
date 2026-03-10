<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDespacho extends Model
{
    use HasFactory;
    protected $table='detalle_despacho';

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }
    public function despacho()
    {
        return $this->belongsTo(Despacho::class, 'despachos_id');
    }
    
}
