<?php

namespace App\Http\Requests\comprador;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class CompradorLoginRequest extends FormRequest
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
            'email' => 'required|email|exists:compradores,email',
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

    
}
