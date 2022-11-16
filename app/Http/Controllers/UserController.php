<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\UserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return $this->userService->getAll();
    }

    public function store(UserRequest $user): JsonResponse
    {
        return $this->userService->saveUserData($user->only('user_name', 'user_email', 'user_password', 'user_role'));
    }

    public function show($id): JsonResponse
    {
        return $this->userService->show($id);
    }

    public function update(UserRequest $user, $id): JsonResponse
    {
        return $this->userService->updateUser($user->only('user_name', 'user_email', 'user_password', 'user_role'), $id);
    }

    public function destroy($id): JsonResponse
    {
        return $this->userService->delete($id);
    }
}
