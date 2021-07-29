<?php

namespace App\Application;

use Exception;
use App\Domain\User;
use DomainException;
use App\Infra\ExternalAuthorizer;
use App\Exceptions\NotAuthorizedException;
use App\Infra\Repositories\WalletRepository;
use App\Infra\TranslatorWalletEloquent;

class TransferService
{
    private $externalAuthorizer;
    private $walletRepository;

    public function __construct(ExternalAuthorizer $externalAuthorizer, WalletRepository $walletRepository)
    {
        $this->externalAuthorizer = $externalAuthorizer;
        $this->walletRepository = $walletRepository;
    }

    public function makeTransfer(array $sender, array $receiver, int $amount)
    {
        $userSender = User::fromArray($sender);
        $userReceiver = User::fromArray($receiver);

        if (!$userSender->getRole()->hasPermission('create')){
            throw new DomainException("Usuario não tem permissão para executar essa ação");
        }

        $userSender->getWallet()->subtractBalance($amount);
        $userReceiver->getWallet()->sumBalance($amount);

        if (!$this->externalAuthorizer->verifyTransaction()){
            throw NotAuthorizedException::create();
        }

        $walletSender = TranslatorWalletEloquent::formatarParaEloquent($userSender->getWallet(), $userSender);
        $walletReceiver = TranslatorWalletEloquent::formatarParaEloquent($userReceiver->getWallet(), $userReceiver);

        $this->walletRepository->updateBalance($walletSender);
        $this->walletRepository->updateBalance($walletReceiver);

    }
}
