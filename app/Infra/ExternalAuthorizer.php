<?php

namespace App\Infra;

use Illuminate\Support\Facades\Http;

class ExternalAuthorizer
{
    /**
     * Acessa api externa para verificar se a transação foi autorizada
     *
     * @return boolean
     */
    public function verifyTransaction():bool
    {
        $response = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

        return $response->json()['message'] === "Autorizado";
    }
}
