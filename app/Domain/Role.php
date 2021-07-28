<?php

namespace App\Domain;

class Role
{
    private int $id;
    private string $role;
    private array $permissions;

    public function __construct(int $id, string $role, array $permissions)
    {
        $this->id = $id;
        $this->role = $role;
        $this->permissions = $permissions;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function hasPermission(string $name)
    {
        return array_reduce($this->permissions, fn($acumulator, $permission) => $acumulator || $name === $permission->getAction(), false);
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public static function fromArray(array $role):self
    {
        return new self($role['id'], $role['role'], array_map(fn($permission) => Permission::fromArray($permission), $role['permissions']));
    }


}
