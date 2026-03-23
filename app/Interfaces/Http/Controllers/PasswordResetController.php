<?php

namespace App\Interfaces\Http\Controllers;
use AhmedTechT\Generator\Traits\HttpResponses;
use App\Application\Services\PasswordResetService;
use App\Interfaces\Http\Requests\PasswordReset\CreatePasswordResetRequest;
use App\Interfaces\Http\Requests\PasswordReset\UpdatePasswordResetRequest;
use App\Interfaces\Http\Resources\PasswordResetResource;

use AhmedTechT\Generator\Base\BaseController;
use App\Application\DTOs\ResetPasswordDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetLinkRequest;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    use HttpResponses;
    public function __construct(private PasswordResetService $passwordResetService)
    {

    }

    public function sendResetLink(SendResetLinkRequest $request)
    {
        $dto = $request->toDto();
        $status = $this->passwordResetService->sendResetLink($dto);
        if ($status === Password::RESET_LINK_SENT) {
            return $this->success(message: 'Reset link sent successfully.');
        } else {
            return $this->error(message: 'Failed to send reset link.');
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $dto = $request->toDto();
        $status = $this->passwordResetService->resetPassword($dto);
        return $status === Password::PASSWORD_RESET
            ? $this->success(message: 'Password reset successfully.')
            : $this->error(message: 'Failed to reset password.');
    }

}