<?php

namespace App\Http\Requests\comprador;

use Illuminate\Foundation\Http\FormRequest;

class CompradorRegisterRequest extends FormRequest
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
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'nickname' => 'required|unique:compradores,nickname',
            'provincia' => 'string',
            'direccion' => 'string',
            'telefono' => ['required','regex:/^(6|7|8|9)[0-9]{8}$/'],
            'email' => 'required|unique:compradores,email|email:rfc,dns',
            'fecha_nac' => 'required|date|before:today|after:1900-01-01',
            'password' => 'required|min:8|string',
            'passwordCompradorConfirmation' => 'required|same:password',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres',

            'apellido.required' => 'El apellido es requerido',
            'apellido.min' => 'El apellido debe tener al menos 3 caracteres',

            'nickname.required' => 'El nickname es requerido',
            'nickname.unique' => 'El nickname ya está en uso',

            'provincia.string' => 'El provincia debe ser una cadena de texto',

            'direccion.string' => 'La dirección debe ser una cadena de texto',

            'telefono.numeric' => 'El teléfono debe ser un número',

            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya está en uso',
            'email.email' => 'El email no es válido',

            'fecha_nac.required' => 'La fecha de nacimiento es requerida',
            'fecha_nac.date' => 'La fecha de nacimiento debe ser una fecha válida',
            'fecha_nac.before' => 'La fecha de nacimiento debe ser anterior a hoy',
            'fecha_nac.after' => 'La fecha de nacimiento debe ser posterior a 01-01-1900',

            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.string' => 'La contraseña debe ser una cadena de texto',

            'passwordCompradorConfirmation.required' => 'La confirmación de la contraseña es requerida',
            'passwordCompradorConfirmation.same' => 'La confirmación de la contraseña debe coincidir con la contraseña',

            'g-recaptcha-response.required' => 'El captcha es requerido',
            'g-recaptcha-response.captcha' => 'Captcha error!',
        ];
    }
}
