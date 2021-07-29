<?php

use App\Domain\Permission;
use App\Domain\Role;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{

    public function testCreateRoletWithSuccess()
    {
        $role = new Role(1, "comum", [new Permission(1, "transferencia", "create")]);
        $this->assertInstanceOf(Role::class, $role);
    }

}
