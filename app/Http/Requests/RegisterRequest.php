<?php

namespace App\Http\Requests;

use App\Application\DTOs\RegisterDto;
use App\Http\utils\ValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ValidationRules::name(),
            'password' => ValidationRules::password(),
            'email' => ValidationRules::email('register'),
        ];
    }

    public function toDto(): RegisterDto
    {
        $data = $this->validated();
        return new RegisterDto(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
        );
    }
}
