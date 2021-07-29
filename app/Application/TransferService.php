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
    private $transactionAuthorizerService;
    private $walletRepository;

    public function __construct(WalletRepository $walletRepository, TransactionAuthorizerService $transactionAuthorizerService)
    {
        $this->transactionAuthorizerService = $transactionAuthorizerService;
        $this->walletRepository = $walletRepository;
    }

    /**
     * Executa a transferência entre carteiras.
     *
     * @param array $sender
     * @param array $receiver
     * @param integer $amount
     * @return void
     */
    public function makeTransfer(array $sender, array $receiver, int $amount)
    {
        // cria uma instância de user do model a partir do array recebido
        $userSender = User::fromArray($sender);
        $userReceiver = User::fromArray($receiver);

        // verifica se o usuário tem permissão para executar a ação
        if (!$userSender->getRole()->hasPermission('create')){
            throw new DomainException("Usuario não tem permissão para executar essa ação");
        }

        // retira o valor do saldo do usuário que fez transferência
        $userSender->getWallet()->subtractBalance($amount);
        // acrescenta o valor ao saldo do usuário que recebeu a transferência
        $userReceiver->getWallet()->sumBalance($amount);

        // verifica se a transferência pode ser realizada
        if (!$this->transactionAuthorizerService->verifyTransaction()){
            throw NotAuthorizedException::create();
        }

        // traduz o usuário do formato domain para o formato do eloquent
        $walletSender = TranslatorWalletEloquent::formatForEloquent($userSender->getWallet(), $userSender);
        $walletReceiver = TranslatorWalletEloquent::formatForEloquent($userReceiver->getWallet(), $userReceiver);

        // faz a atualização dos dados no banco
        $this->walletRepository->updateBalance($walletSender);
        $this->walletRepository->updateBalance($walletReceiver);

    }
}
