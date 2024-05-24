<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTransaccion extends Model
{
    use HasFactory;
    protected $table = 'detalle_transacciones';

    
    protected $fillable = [
        'comprador_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'fecha',
    ];

    public function comprador()
    {
        return $this->belongsTo(Comprador::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
