<?php

namespace App\Http\Requests;

use App\Application\DTOs\ChangePasswrodDto;
use App\Http\utils\ValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswrodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => ValidationRules::password(withConfirm: false),
            'password' => ValidationRules::password()
        ];
    }

    public function toDto()
    {
        $data = $this->validated();
        return new ChangePasswrodDto(
            old_password: $data['old_password'],
            password: $data['password']
        );
    }
}
