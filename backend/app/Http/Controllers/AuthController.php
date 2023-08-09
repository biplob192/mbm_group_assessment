<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\BaseController;
use App\Interfaces\AuthRepositoryInterface;

class AuthController extends BaseController
{
    public function __construct(private AuthRepositoryInterface $authRepository)
    {
    }


    public function register(RegisterRequest $request)
    {
        try {
            return $this->sendResponse($this->authRepository->register($request), 'New user registration successfully.', 201);
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function login(LoginRequest $request)
    {
        try {
            $response = $this->authRepository->login($request);
            return $this->sendResponse($response['data'], $response['message'], $response['status']);
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function logout()
    {
        return $this->sendResponse(auth()->user()->tokens()?->delete(), 'Logout successfully.', 200);
    }


    public function refresh()
    {
        try {
            return $this->sendResponse($this->authRepository->refresh(), 'Refresh token data.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
        return $this->sendError('Invalid refresh token!', '', 401);
    }
}
