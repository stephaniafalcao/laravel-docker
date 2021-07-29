<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Application\TransferService;
use App\Application\NotificationService;
use App\Exceptions\NotAuthorizedException;
use App\Infra\Repositories\UserRepository;

class TransferController extends Controller
{
    /**
     * Handle the incoming request.
     * Transferência entre carteiras.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application\TransferService  $transferService
     * @param  \App\Application\NotificationService  $notificationService
     * @param  \App\Infra\Repositories\UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TransferService $transferService, NotificationService $notificationService, UserRepository $userRepository)
    {
        // usuario que fez transferência
        $sender_id = $request->input('sender_id');
        // usuário que recebe transferência
        $receiver_id = $request->input('receiver_id');
        // valor da transferência
        $amount = $request->input('amount');

        // recupera dados do banco dos usuários envolvidos na transação
        $sender = $userRepository->user($sender_id);
        $receiver = $userRepository->user($receiver_id);

        // caso haja algum problema durante a transferência, todo o processo deve ser desfeito.
        DB::beginTransaction();
        try
        {
            // toda lógica de transferência se encontra nesse serviço.
            $transferService->makeTransfer($sender, $receiver, $amount);

            DB::commit();

            // invoca serviço responsável pela notificação do usuário
            $notificationService->notifyUser();

            return response()->json(['success' => "Transferência realizada com sucesso"], 200);

        } catch(DomainException $e) {

            return response()->json(['error' => $e->getMessage()], 400);

        } catch(NotAuthorizedException $e) {

            return response()->json(['error' => $e->getMessage()], 400);

        } catch(\Throwable $e) {
            DB::rollBack();

            return response()->json(['error' => "Não foi possível fazer a transferência. Tente novamente mais tarde."], 500);
        }

    }
}
