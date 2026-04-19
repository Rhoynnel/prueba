<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    protected $table = 'despachos';

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }

    public function detalleDespacho()
    {
        return $this->hasMany(DetalleDespacho::class, 'despachos_id');
    }

    public function tasa()
    {            
        return $this->belongsTo(Tasa::class, 'tasas_id');
    }

    public function numeroDespacho()
    {
        return 'D-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getTotalDolaresAttribute()
    {
        return $this->detalleDespacho->sum(fn($d) => $d->precio_dolar * $d->cantidad);
    }

    public function getTotalBsAttribute()
    {
        return $this->total_dolares * ($this->tasa->tasa ?? 0);
    }
}
