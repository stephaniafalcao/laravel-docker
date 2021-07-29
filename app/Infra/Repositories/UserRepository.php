<?php

namespace App\Infra\Repositories;

use App\Infra\Models\User;

class UserRepository
{
    /**
     * Retorna os dados de um usuário, bem como seu papel, permissões e carteira
     *
     * @param [type] $id
     * @return array
     */
    public function user($id):array
    {
        return User::with('role.permissions', 'wallet')->find($id)->toArray();
    }
}
