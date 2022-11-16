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

    public function getById($id): Model
    {
        return $this->post::query()->findOrFail($id);
    }

    public function save($data): Model
    {
        $post = new $this->post;
        $post->post_title = $data['post_title'];
        $post->post_slug = Str::slug($data['post_title'], '-');
        $post->post_description = $data['post_description'];
        $post->save();

        return $post->fresh();
    }

    public function update($data, $id): Model
    {
        $post = $this->getById($id);
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
