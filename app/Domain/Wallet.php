<?php

namespace App\Domain;

class Wallet
{
    private int $id;
    private int $balance;

    public function __construct(int $id, int $balance)
    {
        $this->id = $id;
        $this->balance = $balance;
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
    public function getBalance()
    {
        return $this->balance;
    }

    public static function fromArray(array $wallet):self
    {
        return new self($wallet['id'], $wallet['balance']);
    }


    public function subtractBalance(int $subtract)
    {
        $this->balance-= $subtract;
    }

    public function sumBalance(int $sum)
    {
        $this->balance+= $sum;
    }
}
