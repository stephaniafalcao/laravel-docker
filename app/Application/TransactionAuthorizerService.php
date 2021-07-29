<?php

namespace App\Application;

use App\Infra\ExternalAuthorizer;

class TransactionAuthorizerService
{
    private $transactionAuthorizer;

    public function __construct(ExternalAuthorizer $transactionAuthorizer)
    {
        $this->transactionAuthorizer = $transactionAuthorizer;
    }

    /**
     * Invoca método responsável por verificar se transação foi aprovada
     *
     * @return bool
     */
    public function verifyTransaction():bool
    {
        return $this->transactionAuthorizer->verifyTransaction();
    }
}
