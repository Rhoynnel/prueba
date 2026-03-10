<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasa extends Model
{
    protected $table = 'tasas';

    public function compras()
    {
        return $this->hasMany(Compra::class, 'tasas_id', 'id');
    }

    public function despachos()
    {
        return $this->hasMany(Despacho::class, 'tasas_id', 'id');
    }
    

}
