<?php

namespace App\Application\Services;

use App\Application\DTOs\RegisterDto;
use App\Domain\Entities\UserEntity;
use App\Domain\Repo\UserRepo;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\String\b;

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
}