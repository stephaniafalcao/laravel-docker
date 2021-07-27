<?php

namespace App\Infra;

use App\Infra\Models\User;

class UserRepository
{
    public function user($id):User
    {
        return User::find($id);
    }
}
