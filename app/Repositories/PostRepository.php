<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PostRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll(): Collection
    {
        return $this->post::query()->get();
    }

    public function getByUser($user_id): Collection
    {
        return $this->post::query()->where(['user_id' => $user_id])->get();
    }

    public function getById($id): Model
    {
        return $this->post::query()->findOrFail($id);
    }

    public function getByUserPostId($post_id, $user_id): Model
    {
        return $this->post::query()->where(['user_id', '=', $user_id, 'post_id', '=',  $post_id])->firstOrFail();
    }
    public function save($data, $user_id): Model
    {
        $post = new $this->post;
        $post->post_title = $data['post_title'];
        $post->post_slug = Str::slug($data['post_title'], '-');
        $post->post_description = $data['post_description'];
        $post->user_id = $user_id;
        $post->save();

        return $post->fresh();
    }

    public function update($data, $post_id, $user_id): Model
    {
        $post = $this->getByUserPostId($post_id, $user_id);
        $post->post_title = $data['post_title'];
        $post->post_slug = Str::slug($data['post_title'], '-');
        $post->post_description = $data['post_description'];
        $post->update();

        return $post->refresh();
    }

    public function delete($id): void
    {
        $this->getById($id)->delete();
    }
}
