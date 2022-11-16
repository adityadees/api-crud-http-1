<?php

namespace App\Http\Library;

use Illuminate\Http\JsonResponse;

trait RoleHelper
{
    protected function isAdmin($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('Admin');
        }

        return false;
    }

    protected function isNormal($user): bool
    {

        if (!empty($user)) {
            return $user->tokenCan('Normal');
        }

        return false;
    }

    protected function isManager($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('Manager');
        }

        return false;
    }
}
