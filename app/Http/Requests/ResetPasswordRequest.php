<?php

namespace App\Http\Requests;

use App\Application\DTOs\ResetPasswordDto;
use App\Http\utils\ValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => ValidationRules::email('login'),
            'token' => 'required|string',
            'password' => ValidationRules::password()
        ];
    }

    public function toDto(): ResetPasswordDto
    {
        $data = $this->validated();
        return new ResetPasswordDto(
            email: $data['email'],
            token: $data['token'],
            password: $data['password']
        );
    }

}
