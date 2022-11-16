<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $post): JsonResponse
    {
        return $this->postService->get($post->user());
    }

    public function store(PostRequest $post): JsonResponse
    {
        return $this->postService->savePostData($post->only('post_title', 'post_description'), $post->user()->user_id);
    }

    public function show($id): JsonResponse
    {
        return $this->postService->show($id);
    }

    public function update(PostRequest $post, $id): JsonResponse
    {
        return $this->postService->updatePost($post->only('post_title', 'post_description'), $id, $post->user_id);
    }

    public function destroy($id): JsonResponse
    {
        return $this->postService->delete($id);
    }
}
