<?php

namespace App\Http\Requests;

use App\Application\DTOs\SendResetLinkDto;
use App\Http\utils\ValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SendResetLinkRequest extends FormRequest
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
            'email' => ValidationRules::email('login')
        ];
    }

    public function toDto(): SendResetLinkDto
    {
        $data = $this->validated();
        return new SendResetLinkDto(
            email: $data['email'],
        );
    }
}
