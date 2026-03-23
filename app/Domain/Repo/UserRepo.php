<?php
namespace App\Domain\Repo;
use AhmedTechT\Generator\Base\BaseRepo;
use App\Models\User;

interface UserRepo extends BaseRepo
{
    public function register($entity);
    public function secureUpdatePassword(User $user, string $plainPassword);
}

