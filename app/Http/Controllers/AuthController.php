<?php

namespace App\Http\Controllers;

use AhmedTechT\Generator\Traits\HttpResponses;

class AuthController extends Controller
{

    use HttpResponses;
    public function login()
    {
        return $this->success(message: 'Login successful');
    }
}