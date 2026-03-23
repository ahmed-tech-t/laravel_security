<?php

namespace App\Application\Services;

use AhmedTechT\Generator\Base\BaseService;
use App\Application\DTOs\ResetPasswordDto;
use App\Application\DTOs\SendResetLinkDto;
use App\Domain\Entities\PasswordResetEntity;
use App\Domain\Repo\PasswordResetRepo;
use App\Domain\Repo\UserRepo;
use Illuminate\Support\Facades\Password;

class PasswordResetService
{
    public function __construct(private UserRepo $userRepo)
    {
    }
    public function sendResetLink(SendResetLinkDto $dto)
    {
        return Password::sendResetLink($dto->toArray());
    }

    public function resetPassword(ResetPasswordDto $dto)
    {
        return Password::reset(
            $dto->toArray(),
            function ($user, $password) {
                $this->userRepo->secureUpdatePassword($user, $password);
            }
        );
    }
}