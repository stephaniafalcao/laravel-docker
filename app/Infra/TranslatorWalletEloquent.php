<?php

namespace App\Infra;

use App\Domain\User;
use App\Domain\Wallet;
use App\Infra\Models\Wallet as WalletEloquent;

class TranslatorWalletEloquent
{
    /**
     * Faz a conversão dos objetos do domain para o formato do banco - eloquent
     *
     * @param Wallet $wallet
     * @param User $user
     * @return WalletEloquent
     */
    public static function formatForEloquent(Wallet $wallet, User $user):WalletEloquent
    {
        $walletPrepare['id'] = $wallet->getId();
        $walletPrepare['balance'] = $wallet->getBalance();
        $walletPrepare['user_id'] = $user->getId();

        $walletEloquent = new WalletEloquent($walletPrepare);

        $walletEloquent->exists = true;

        return $walletEloquent;
    }
}
