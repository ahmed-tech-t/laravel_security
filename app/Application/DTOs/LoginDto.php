<?php

namespace App\Application\DTOs;

class LoginDto
{

    public function __construct(
        public string $email,
        public string $password,
    ) {

    }


    public function toArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}