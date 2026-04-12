<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';

    // habilitamos asignación masiva para los campos que utilizamos en la importación
    protected $fillable = [
        'codigo',
        'barra',
        'nombre',
        'stock_actual',
        'categorias_id',
        'precio_venta',
        'precio_compra',
        // se pueden agregar precios u otros campos si la hoja los contiene
    ];


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
