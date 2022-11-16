<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Repositories\PostRepository;
use App\Http\Library\RoleHelper;

class PostService extends Service
{
    protected $postRepository;
    use RoleHelper;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function get($data): JsonResponse
    {
        if ($this->isNormal($data)) {
            $posts = $this->postRepository->getByUser($data->user_id);
        } else {
            $posts = $this->postRepository->getAll();
        }
        return $this->ApiSuccessResponse($posts);
    }
    public function getAll(): JsonResponse
    {
        $posts = $this->postRepository->getAll();

        return $this->ApiSuccessResponse($posts);
    }

    public function getByUser($user_id): JsonResponse
    {
        $posts = $this->postRepository->getByUser($user_id);

        return $this->ApiSuccessResponse($posts);
    }

    public function savePostData($data, $user_id): JsonResponse
    {
        $post = $this->postRepository->save($data, $user_id);

        return $this->ApiSuccessResponse($post, 'Post Created Successfully');
    }

    public function show($id): JsonResponse
    {
        $post = $this->postRepository->getById($id);

        return $this->ApiSuccessResponse($post);
    }

    public function updatePost($data, $id, $user_id): JsonResponse
    {
        $post = $this->postRepository->update($data, $id, $user_id);

        return $this->ApiSuccessResponse($post);
    }

    public function delete($id): JsonResponse
    {
        $this->postRepository->delete($id);

        return $this->ApiSuccessResponse(null, 'Post Deleted Successfully');
    }
}
