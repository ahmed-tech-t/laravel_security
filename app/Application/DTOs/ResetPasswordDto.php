<?php

namespace App\Application\DTOs;



class ResetPasswordDto
{

    public function __construct(
        public string $email,
        public string $token,
        public string $password
    ) {

    }


    public function toArray()
    {
        return [
            'email' => $this->email,
            'token' => $this->token,
            'password' => $this->password
        ];
    }
}