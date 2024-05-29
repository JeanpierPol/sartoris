<?php

namespace App\Http\Requests\vendedor;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class VendedorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'min:3',
            'apellido' => 'min:3',
            'pais'=>'min:3',
            'direccion'=>'min:3',
            'telefono'=>'min:3|numeric',
            'email' => ['email', Rule::unique('vendedores')->ignore($this->user()->id)],
            'fecha_nac ' => 'before:today|after:01-01-1900',
            'imagen' => 'mimes:jpeg,jpg,png|max:2048',

        ];
    }

    public function messages()
    {
        return [
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres',

            'apellido.min' => 'El apellido debe tener al menos 3 caracteres',

            'pais.min' => 'El país debe tener al menos 3 caracteres',

            'direccion.min' => 'La dirección debe tener al menos 3 caracteres',

            'telefono.min' => 'El teléfono debe tener al menos 3 caracteres',
            'telefono.numeric' => 'El teléfono debe ser un número',

            'email.email' => 'El email debe ser una dirección de correo válida',
            'email.unique' => 'El email ya está en uso',

            'fecha_nac.date' => 'La fecha de nacimiento debe ser una fecha válida',
            'fecha_nac.before' => 'La fecha de nacimiento debe ser anterior a hoy',
            'fecha_nac.after' => 'La fecha de nacimiento debe ser posterior a 01-01-1900',

            'imagen.mimes' => 'La imagen debe ser un archivo de tipo: png, jpg, jpeg',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB',
        ];
    }
}
