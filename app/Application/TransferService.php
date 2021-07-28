<?php

namespace App\Application;

use App\Domain\User;

class TransferService
{
    public function makeTransfer(array $sender, array $receiver, int $amount)
    {
        $userSender = User::fromArray($sender);
        $userReceiver = User::fromArray($receiver);

        if (!$userSender->getRole()->hasPermission('fazer')){
            echo 'deu ruim';
            return;
        }

        $userSender->getWallet()->subtractBalance($amount);
        $userReceiver->getWallet()->sumBalance($amount);

        try
        {
            
        } catch() {

        }

        echo $userSender->getWallet()->getBalance();
        echo "<br>";
        echo $userReceiver->getWallet()->getBalance();

    }
}
