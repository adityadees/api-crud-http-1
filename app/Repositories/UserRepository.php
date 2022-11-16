<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll(): Collection
    {
        return $this->user::query()->get();
    }

    public function getById($id): Model
    {
        return $this->user::query()->findOrFail($id);
    }
    public function getBy($data): Model
    {
        return $this->user::where('user_email', $data['user_email'])->firstOrFail();
    }

    public function save($data): Model
    {
        $user = new $this->user;
        $user->user_name = $data['user_name'];
        $user->user_email = $data['user_email'];
        $user->user_password = Hash::make($data['user_password']);
        $user->user_role = $data['user_role'];
        $user->save();

        return $user->fresh();
    }

    public function update($data, $id): Model
    {
        $user = $this->getById($id);
        $user->user_name = $data['user_name'];
        $user->user_email = $data['user_email'];
        $user->user_password = Hash::make($data['user_password']);
        $user->user_role = $data['user_role'];
        $user->update();

        return $user->refresh();
    }

    public function delete($id): void
    {
        $this->getById($id)->delete();
    }
}
