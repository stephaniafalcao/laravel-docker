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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TransferService $transferService, NotificationService $notificationService, UserRepository $userRepository)
    {
        $sender_id = $request->input('sender_id');
        $receiver_id = $request->input('receiver_id');
        $amount = $request->input('amount');

        $sender = $userRepository->user($sender_id);
        $receiver = $userRepository->user($receiver_id);

        DB::beginTransaction();
        try
        {
            $transferService->makeTransfer($sender, $receiver, $amount);

            DB::commit();

            $notificationService->notifyUser();

            return response()->json(['sucesso' => "Transferencia realizada com sucesso"], 200);

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
