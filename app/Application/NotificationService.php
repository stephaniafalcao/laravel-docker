<?php

namespace App\Application;

use App\Infra\ExternalNotifier;

class NotificationService
{
    private $externalNotifier;
    private $walletRepository;

    public function __construct(ExternalNotifier $externalNotifier)
    {
        $this->externalNotifier = $externalNotifier;
    }

    public function notifyUser()
    {
        $this->externalNotifier->notifyUser();
    }
}
