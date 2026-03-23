<?php

namespace App\Application\DTOs;



class ChangePasswrodDto
{

    public function __construct(
        public string $old_password,
        public string $password
    ) {}


    public function toArray()
    {
        return [
            'old_password' => $this->old_password,
            'password' => $this->password
        ];
    }
}
