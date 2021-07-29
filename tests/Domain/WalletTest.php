<?php

use App\Domain\Wallet;
use PHPUnit\Framework\TestCase;

class WalletTest extends TestCase
{

    public function testCreateWalletWithSuccess()
    {
        $wallet = new Wallet(1, 200);
        $this->assertInstanceOf(Wallet::class, $wallet);
    }

}
