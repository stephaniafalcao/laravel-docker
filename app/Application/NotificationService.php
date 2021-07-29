<?php

namespace App\Application;

use App\Infra\ExternalNotifier;

class NotificationService
{
    private $externalNotifier;

    public function __construct(ExternalNotifier $externalNotifier)
    {
        $this->externalNotifier = $externalNotifier;
    }

    /**
     * Invoca método responsável pela notificação do usuário
     *
     * @return void
     */
    public function notifyUser()
    {
        $this->externalNotifier->notifyUser();
    }
}
