<?php

namespace App\Domain;

class Permission
{
    private int $id;
    private string $type;
    private string $action;

    public function __construct(int $id, string $type, string $action)
    {
        $this->id = $id;
        $this->$type = $type;
        $this->action = $action;
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Get the value of action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Transforma o array recebido em um objeto do domain
     *
     * @param array $permission
     * @return self
     */
    public static function fromArray(array $permission):self
    {
        return new self($permission['id'], $permission['type'], $permission['action']);
    }
}
