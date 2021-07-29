<?php


use App\Domain\Role;
use App\Domain\User;
use App\Domain\Wallet;
use App\Domain\Permission;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testCreateUserWithSuccess()
    {
        $user = new User(3, "teste3", "teste3@teste.com.br", "12345678", "123456", new Role(1, "comum", [new Permission(1, "transferencia", "create")]), new Wallet(1, 200));
        $this->assertInstanceOf(User::class, $user);
    }

}
