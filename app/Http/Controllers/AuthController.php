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
    public function __construct(private AuthService $service) {}
    public function login(LoginRequest $request)
    {
        $data = $request->toDto();
        return $this->success(
            $this->service->login(dto: $data, deviceName: $request->header('User-Agent'))
        );
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->service->register($request->toDto());

        return $this->success(
            UserResource::make($result),
            'User registered successfully'
        );
    }

    public function logout()
    {
        return $this->success(
            $this->service->logout()
        );
    }

    public function logoutAll()
    {
        return $this->success(
            $this->service->logoutAll()
        );
    }
}
