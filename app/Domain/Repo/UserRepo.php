<?php
namespace App\Domain\Repo;
use AhmedTechT\Generator\Base\BaseRepo;

interface UserRepo extends BaseRepo
{
    public function register($entity);
}

