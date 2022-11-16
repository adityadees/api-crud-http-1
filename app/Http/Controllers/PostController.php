<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\PostRequest;
use App\Http\Library\RoleHelper;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    use RoleHelper;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $post): JsonResponse
    {
        if ($this->isNormal($post->user())) {
            return $this->postService->getByUser($post->user());
        } else {
            return $this->postService->getAll();
        }
    }

    public function store(PostRequest $post): JsonResponse
    {
        return $this->postService->savePostData($post->only('post_title', 'post_description'));
    }

    public function show($id): JsonResponse
    {
        return $this->postService->show($id);
    }

    public function update(PostRequest $post, $id): JsonResponse
    {
        return $this->postService->updatePost($post->only('post_title', 'post_description'), $id);
    }

    public function destroy($id): JsonResponse
    {
        return $this->postService->delete($id);
    }
}
