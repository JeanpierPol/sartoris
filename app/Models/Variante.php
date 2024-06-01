<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'talla',
        'precio_venta',
        'descuento',
        'existencias',
    ];


    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
