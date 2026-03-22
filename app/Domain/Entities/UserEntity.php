<?php

namespace App\Domain\Entities;

use Carbon\Carbon;


class UserEntity
{

    public function __construct(
        public string $name,
        public string $email,
        public ?int $id = null,
        public ?string $token = null,
        public ?string $password = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
    ) {

    }

    public static function create(array $data)
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
        );
    }
    public function update(array $data)
    {
        $this->name = $data['name'] ?? $this->name;
        $this->email = $data['email'] ?? $this->email;
    }

    public function updatePassword(string $password)
    {
        $this->password = $password;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}