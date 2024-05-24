<?php

namespace App\Http\Requests\vendedor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class VendedorLoginRequest extends FormRequest
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
            'email' => 'required|email|exists:vendedores,email',
            'password' => 'required|string',
        ];
        
    }
    public function getCredentials()
    {
        if ($this->isEmail($this->input('email'))) {
            return [
                'email' => $this->input('email'),
                'password' => $this->input('password')
            ];
        }
        return [];
    }
    
    
    

    public function isEmail($value)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return !$factory->make(['email' => $value], ['email' => 'email'])->fails();
    }

    public function messages()
    {
        return [
            'email.required' => 'El email es requerido',
            'password.required' => 'la contraseña es obligatoria',
        ];
    }
}
