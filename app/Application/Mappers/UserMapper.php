<?php

namespace App\Application\Mappers;

use AhmedTechT\Generator\Base\BaseMapper;
use App\Domain\Entities\UserEntity;

class UserMapper implements BaseMapper
{
    public static function modelToEntity($model, ?string $token = null)
    {
        return new UserEntity(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            hashed_password: $model->password,
            token: $token,
            created_at: $model->created_at,
            updated_at: $model->updated_at,
        );
    }
}
