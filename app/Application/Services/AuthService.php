<?php

namespace App\Application\Services;

use App\Application\DTOs\LoginDto;
use App\Application\DTOs\RegisterDto;
use App\Domain\Entities\UserEntity;
use App\Domain\Repo\UserRepo;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\b;

class AuthService
{
    public function __construct(private UserRepo $repo) {}

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
