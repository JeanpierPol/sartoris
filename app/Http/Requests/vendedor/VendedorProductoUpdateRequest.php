<?php

namespace App\Http\Requests\vendedor;

use Illuminate\Foundation\Http\FormRequest;

class VendedorProductoUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|unique:productos,nombre,' . $this->id,
            'descripcion' => '',
            'imagen_portada.*' => 'mimes:png,jpg,jpeg',
            'imagenes' => 'array',
            'talla' => 'required|array',
            'talla.*' => 'required|string|in:S,M,L',
            'precio_venta' => 'required|array',
            'precio_venta.*' => 'required|numeric|min:0',
            'descuento' => 'required|array',
            'descuento.*' => 'required|numeric|min:0',
            'existencias' => 'required|array',
            'existencias.*' => 'required|integer|min:0',
        ];        
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.unique' => 'El nombre ya está en uso',
            'imagen_portada.*.mimes' => 'La imagen debe ser un archivo de tipo: png, jpg, jpeg',
            'talla.required' => 'La talla es requerida',
            'talla.*.required' => 'Cada talla es requerida',
            'talla.*.in' => 'Las tallas deben ser S, M, o L',
            'precio_venta.required' => 'El precio de venta es requerido',
            'precio_venta.*.required' => 'El precio de venta es requerido para cada variante',
            'precio_venta.*.numeric' => 'El precio de venta debe ser un número',
            'precio_venta.*.gt' => 'El precio de venta debe ser mayor que 0',
            'descuento.required' => 'El descuento es requerido',
            'descuento.*.required' => 'El descuento es requerido para cada variante',
            'descuento.*.numeric' => 'El descuento debe ser un número entero',
            'descuento.*.gt' => 'El descuento debe ser mayor que 0',
            'existencias.required' => 'Las existencias son requeridas',
            'existencias.*.required' => 'Las existencias son requeridas para cada variante',
            'existencias.*.integer' => 'Las existencias deben ser un número entero',
            'existencias.*.min' => 'Las existencias no pueden ser negativas',
        ];
    }
}
