<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\UserRequest;
use App\Http\Requests\Api\LoginRequest;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(UserRequest $user)
    {
        return $this->userService->saveUserData($user->only('user_name', 'user_email', 'user_password', 'user_role'));
    }
    public function login(LoginRequest $user)
    {
        return $this->userService->getBy($user->only('user_email', 'password'));
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
