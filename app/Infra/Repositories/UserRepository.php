<?php

namespace App\Infra\Repositories;

use App\Infra\Models\User;

class UserRepository
{
    public function user($id):array
    {
        return User::with('role.permissions', 'wallet')->find($id)->toArray();
    }
}
