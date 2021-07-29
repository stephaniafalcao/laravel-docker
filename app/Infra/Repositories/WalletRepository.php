<?php

namespace App\Infra\Repositories;

use App\Infra\Models\Wallet;
use Exception;

class WalletRepository
{
    public function updateBalance(Wallet $wallet):void
    {
        $wallet->save();
    }
}
