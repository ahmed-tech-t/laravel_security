<?php

namespace App\Http\Requests;

use App\Application\DTOs\LoginDto;
use App\Http\utils\ValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

use function Laravel\Prompts\confirm;

class LoginRequest extends FormRequest
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
            'password' => ValidationRules::password(withConfirm: false),
        ];
    }

    public function toDto(): LoginDto
    {
        $data = $this->validated();
        return new LoginDto(
            email: $data['email'],
            password: $data['password'],
        );
    }
}
