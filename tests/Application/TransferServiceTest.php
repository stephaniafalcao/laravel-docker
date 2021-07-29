<?php

use PHPUnit\Framework\TestCase;
use App\Application\TransferService;
use App\Exceptions\NotAuthorizedException;
use App\Infra\Repositories\WalletRepository;
use PHPUnit\Framework\MockObject\MockObject;
use App\Application\TransactionAuthorizerService;

class TransferServiceTest extends TestCase
{
    /**
     * @var WalletRepository&MockObject
     */
    private $walletRepository;
    /**
     * @var TransactionAuthorizerService&MockObject
     */
    private $transactionAuthorizerService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->walletRepository = $this->createMock(WalletRepository::class);
        $this->transactionAuthorizerService = $this->createMock(TransactionAuthorizerService::class);
    }

    private function createUser(string $role) {
        return [
            "id" => random_int(0,10),
            "name" => "teste" . uniqid(),
            "email" => "teste" . uniqid() . "@gmail.com",
            "document" => uniqid(),
            "password" => "123456",
            "created_at" => "2021-07-27T15:08:56.000000Z",
            "updated_at" => null,
            "role_id" => 1,
            "remember_token" => null,
            "role" => [
              "id" => 1,
              "role" => "comum",
              "created_at" => "2021-07-27T15:08:18.000000Z",
              "updated_at" => null,
              "permissions" => [
                ...($role == "comum"?
                    [   [
                            "id" => 1,
                            "type" => "transferencia",
                            "action" => "create",
                            "created_at" => null,
                            "updated_at" => null,
                            "pivot" => [
                                "role_id" => 1,
                                "permission_id" => 1
                            ]
                        ]
                    ] : [])
              ]
            ],
            "wallet" => [
              "id" => 1,
              "balance" => "900.00",
              "user_id" => 1,
              "created_at" => null,
              "updated_at" => "2021-07-29T19:13:13.000000Z"
            ]
        ];
    }

    public function testMakeTransferWithSuccess()
    {

        $this->walletRepository->expects($this->exactly(2))->method("updateBalance");
        $this->transactionAuthorizerService->expects($this->once())->method("verifyTransaction")->willReturn(true);

        $transferService = new TransferService($this->walletRepository, $this->transactionAuthorizerService);

        $transferService->makeTransfer($this->createUser("comum"), $this->createUser("lojista"), 100);
    }

    public function testMakeTransferUserWithNotPermission()
    {
        $this->expectException(DomainException::class);

        $this->walletRepository->expects($this->never())->method("updateBalance");
        $this->transactionAuthorizerService->expects($this->never())->method("verifyTransaction");

        $transferService = new TransferService($this->walletRepository, $this->transactionAuthorizerService);

        $transferService->makeTransfer($this->createUser("lojista"), $this->createUser("lojista"), 100);
    }

    public function testTransferNotAuthorized()
    {
        $this->expectException(NotAuthorizedException::class);

        $this->walletRepository->expects($this->never())->method("updateBalance");
        $this->transactionAuthorizerService->expects($this->once())->method("verifyTransaction")->willReturn(false);

        $transferService = new TransferService($this->walletRepository, $this->transactionAuthorizerService);

        $transferService->makeTransfer($this->createUser("comum"), $this->createUser("lojista"), 100);
    }

    public function testMakeTransferWithNotEnoughBalance()
    {
        $this->expectException(DomainException::class);

        $this->walletRepository->expects($this->never())->method("updateBalance");
        $this->transactionAuthorizerService->expects($this->never())->method("verifyTransaction")->willReturn(true);

        $transferService = new TransferService($this->walletRepository, $this->transactionAuthorizerService);

        $transferService->makeTransfer($this->createUser("comum"), $this->createUser("lojista"), 1000);
    }
}
