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
            'precio_venta' => 'required|numeric|gt:0',
            'descuento' => 'required|numeric|gt:0',
            'existencias' => 'required|integer|min:0',
        ];        
        
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.unique' => 'El nombre ya está en uso',
            'imagen_portada.*.mimes' => 'La imagen debe ser un archivo de tipo: png, jpg, jpeg',

            'precio_venta.required' => 'El precio de venta es requerido',
            'precio_venta.numeric' => 'El precio de venta debe ser un número',
            'precio_venta.between' => 'El precio de venta debe estar entre 0 y 9999.99',

            'descuento.required' => 'El descuento es requerido',
            'descuento.integer' => 'El descuento debe ser un número entero',

            'existencias.required' => 'Las existencias son requeridas',
            'existencias.integer' => 'Las existencias deben ser un número entero',
        ];
    }
}
