<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Repositories\PostRepository;

class PostService extends Service
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll(): JsonResponse
    {
        $posts = $this->postRepository->getAll();

        return $this->ApiSuccessResponse($posts);
    }

    public function getByUser($data): JsonResponse
    {
        $posts = $this->postRepository->getByUser($data);

        return $this->ApiSuccessResponse($posts);
    }

    public function getByRole(): JsonResponse
    {
        $posts = $this->postRepository->getByRole();

        return $this->ApiSuccessResponse($posts);
    }

    public function savePostData($data): JsonResponse
    {
        $post = $this->postRepository->save($data);

        return $this->ApiSuccessResponse($post, 'Post Created Successfully');
    }

    public function show($id): JsonResponse
    {
        $post = $this->postRepository->getById($id);

        return $this->ApiSuccessResponse($post);
    }

    public function updatePost($data, $id): JsonResponse
    {
        $post = $this->postRepository->update($data, $id);

        return $this->ApiSuccessResponse($post);
    }

    public function delete($id): JsonResponse
    {
        $this->postRepository->delete($id);

        return $this->ApiSuccessResponse(null, 'Post Deleted Successfully');
    }
}
