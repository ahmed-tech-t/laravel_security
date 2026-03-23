<?php

namespace App\Application\Services;

use App\Application\DTOs\ChangePasswordDto;
use App\Application\DTOs\LoginDto;
use App\Application\DTOs\RegisterDto;
use App\Domain\Entities\UserEntity;
use App\Domain\Repo\UserRepo;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthService
{
    public function __construct(private UserRepo $repo)
    {
    }

    public function register(RegisterDto $dto)
    {
        $entity = UserEntity::create($dto->toArray());
        return $this->repo->register($entity);
    }

    public function login(LoginDto $dto, $deviceName)
    {
        if (Auth::attempt($dto->toArray())) {
            $token = Auth::user()->createToken($deviceName)->plainTextToken;
            return [
                'token' => $token
            ];
        }
        throw new Exception('Invalid credentials', 401);
    }

    public function changePassword(ChangePasswordDto $dto)
    {
        $userId = Auth::id();
        $user = $this->repo->findById($userId);

        if (!Hash::check($dto->old_password, $user->hashed_password)) {
            abort(422, 'The current password you entered is incorrect.');
        }
        $user->password = $dto->password;
        $this->repo->update($user);
        return true;
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return true;
    }

    public function logoutAll()
    {
        Auth::user()->tokens()->delete();
        return true;
    }
}
