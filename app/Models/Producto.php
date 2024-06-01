<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen_portada', 
        'imagenes', 
        'vendedor_id',
    ];

    public function getImagenesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getImagenPortadaAttribute()
    {
        $imagenes = $this->imagenes;
        return $imagenes ? $imagenes[0] : null;
    }

    public function oldImages()
    {
        $imagenes = is_string($this->imagenes) ? json_decode($this->imagenes, true) : $this->imagenes;
        $imagenes = is_array($imagenes) ? $imagenes : [];
        return array_merge([$this->imagen_portada], $imagenes);
    }

    /**
     * Relaciones
     */

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'producto_categoria');
    }

    public function detalleTransacciones()
    {
        return $this->hasMany(DetalleTransaccion::class);
    }

    public function variantes()
    {
        return $this->hasMany(Variante::class);
    }
    
    public function getRouteKeyName()
    {
        return 'nombre';
    }
    
}
