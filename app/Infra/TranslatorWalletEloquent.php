<?php

namespace App\Infra;

use App\Domain\User;
use App\Domain\Wallet;
use App\Infra\Models\Wallet as WalletEloquent;

class TranslatorWalletEloquent
{
    public static function formatarParaEloquent(Wallet $wallet, User $user):WalletEloquent
    {
        $walletPrepare['id'] = $wallet->getId();
        $walletPrepare['balance'] = $wallet->getBalance();
        $walletPrepare['user_id'] = $user->getId();

        $walletEloquent = new WalletEloquent($walletPrepare);

        $walletEloquent->exists = true;

        return $walletEloquent;
    }
}
