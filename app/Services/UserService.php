<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepository;

class UserService extends Service
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): JsonResponse
    {
        $users = $this->userRepository->getAll();

        return $this->ApiSuccessResponse($users);
    }

    public function getBy($data): JsonResponse
    {
        $users = $this->userRepository->getBy($data);
        $token = $users->createToken('auth_token', [$users->user_role])->plainTextToken;
        return $this->ApiSuccessResponse($token);
    }
    public function saveUserData($data): JsonResponse
    {
        $user = $this->userRepository->save($data);

        return $this->ApiSuccessResponse($user, 'User Created Successfully');
    }

    public function show($id): JsonResponse
    {
        $user = $this->userRepository->getById($id);

        return $this->ApiSuccessResponse($user);
    }

    public function updateUser($data, $id): JsonResponse
    {
        $user = $this->userRepository->update($data, $id);

        return $this->ApiSuccessResponse($user);
    }

    public function delete($id): JsonResponse
    {
        $this->userRepository->delete($id);

        return $this->ApiSuccessResponse(null, 'User Deleted Successfully');
    }
}
