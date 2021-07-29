<?php

namespace Database\Seeders;

use App\Infra\Models\Wallet;
use App\Infra\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $roleComum = \App\Infra\Models\Role::create(["role" => "comum"]);
       $roleLojista = \App\Infra\Models\Role::create(["role" => "lojista"]);

       $user1 = new User(["name" => "user1",
                          "email" => "user1@teste.com.br",
                          "document" => "123456789",
                          "password" => "123456"]);

       $user1->role()->associate($roleComum);

       $user1->save();

       $user2 = new User(["name" => "user2",
                          "email" => "user2@teste.com.br",
                          "document" => "123456788",
                          "password" => "123456"]);

       $user2->role()->associate($roleLojista);

       $user2->save();

       $walletUser1 = new Wallet(['balance' => 1000]);

       $walletUser1->user()->associate($user1);

       $walletUser1->save();

       $walletUser2 = new Wallet(['balance' => 1000]);

       $walletUser2->user()->associate($user2);

       $walletUser2->save();

       $permission = \App\Infra\Models\Permission::create(["type" => "transfer", "action" => "create"]);

       $roleComum->permissions()->attach($permission->id);


    }
}
