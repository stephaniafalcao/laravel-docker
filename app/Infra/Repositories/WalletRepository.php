<?php

namespace App\Infra\Repositories;

use App\Infra\Models\Wallet;
use Exception;

class WalletRepository
{
    /**
     * Altera valor do saldo pós transação
     *
     * @param Wallet $wallet
     * @return void
     */
    public function updateBalance(Wallet $wallet):void
    {
        $wallet->save();
    }
}
