<?php

namespace App\Application\DTOs;



class SendResetLinkDto
{

    public function __construct(
        public string $email
    ) {

    }


    public function toArray()
    {
        return [
            'email' => $this->email
        ];

    }
}