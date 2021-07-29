<?php

use App\Domain\Permission;
use PHPUnit\Framework\TestCase;

class PermissionTest extends TestCase
{

    public function testCreatePermissionWithSuccess()
    {
        $permission = new Permission(1, "transferencia", "create");
        $this->assertInstanceOf(Permission::class, $permission);
    }

}
