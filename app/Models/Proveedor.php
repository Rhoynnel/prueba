<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    public function compras()
    {
        return $this->hasMany(Compra::class, 'proveedores_id', 'id');
    }
}
