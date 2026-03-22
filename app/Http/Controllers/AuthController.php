<?php

namespace App\Http\Controllers;

use AhmedTechT\Generator\Traits\HttpResponses;
use App\Application\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{

    use HttpResponses;
    public function __construct(private AuthService $service)
    {

    }
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

    }

    public function register(RegisterRequest $request)
    {
        $result = $this->service->register($request->toDto());

        return $this->success(
            UserResource::make($result),
            'User registered successfully'
        );
    }
}