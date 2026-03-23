<?php

namespace App\Application\Services;

use App\Application\DTOs\ChangePasswrodDto;
use App\Application\DTOs\LoginDto;
use App\Application\DTOs\RegisterDto;
use App\Application\DTOs\ResetPasswrodDtoDto;
use App\Domain\Entities\UserEntity;
use App\Domain\Repo\UserRepo;
use App\Http\Requests\ResetPasswrodRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function changePassword(ChangePasswrodDto $dto)
    {
        $userId = Auth::id();
        $user = $this->repo->findById($userId);

        if (!Hash::check($dto->old_password, $user->hashed_password)) {
            abort(422, 'The current password you entered is incorrect.');
        }
        $user->password = Hash::make($dto->password);
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
