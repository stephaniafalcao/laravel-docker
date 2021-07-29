<?php

namespace App\Infra;

use Illuminate\Support\Facades\Http;

class ExternalNotifier
{
    /**
     * Notifica usuário após transação
     *
     * @return boolean
     */
    public function notifyUser():bool
    {
        $response = Http::get('https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04');

        return $response->json()['message'] === "Enviado";
    }
}
