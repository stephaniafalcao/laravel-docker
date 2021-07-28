<?php

namespace App\Domain;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $document;
    private string $password;
    private Role $role;
    private Wallet $wallet;

    public function __construct(int $id, string $name, string $email, string $document, string $password, Role $role, Wallet $wallet)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->document = $document;
        $this->password = $password;
        $this->role = $role;
        $this->wallet = $wallet;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of document
     */
    public function getDocument()
    {
        return $this->document;
    }


    public function getRole()
    {
        return $this->role;
    }

    public function getWallet()
    {
        return $this->wallet;
    }

    public static function fromArray(array $user):self
    {
        return new self($user['id'], $user['name'], $user['email'], $user['document'], $user['password'], Role::fromArray($user['role']), Wallet::fromArray($user['wallet']) );
    }

}
