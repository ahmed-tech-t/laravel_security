<?php

namespace App\Infrastructure\Persistence\Repo;

use AhmedTechT\Generator\Base\EloquentRepoImpl\BaseERepo;
use App\Application\Mappers\UserMapper;
use App\Domain\Repo\UserRepo;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EUserRepo extends BaseERepo implements UserRepo
{
    protected $modelClass = User::class;
    protected $mapper = UserMapper::class;

    // protected $queryContext = ;

    protected array $searchFilters = [];

    protected array $withForPaginate = [];
    protected array $defaultRelationships = [];

    public function register($entity)
    {
        return DB::transaction(function () use ($entity) {
            $user = User::create($entity->toArray())->refresh();
            $token = $user->createToken('auth_token')->plainTextToken;
            return UserMapper::modelToEntity($user, $token);
        });
    }


    public function secureUpdatePassword(User $user, string $plainPassword)
    {
        $user->password = $plainPassword;
        $user->save();
    }
}
