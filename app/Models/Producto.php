<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id');
    }

    // Definimos las relaciones para que Laravel sepa de dónde sacar los datos
    public function detalleCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'productos_id', 'id');
    }

    public function detalleDespacho()
    {
        return $this->hasMany(DetalleDespacho::class, 'productos_id', 'id');
    }

    /*// Creamos un atributo virtual
    public function getStockAttribute()
    {
        return $this->detalleCompra()->sum('cantidad') - $this->detalleDespacho()->sum('cantidad');
    }*/
}
