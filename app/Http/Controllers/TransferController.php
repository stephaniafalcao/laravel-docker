<?php

namespace App\Http\Controllers;

use App\Infra\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Application\TransferService;

class TransferController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TransferService $transferService, UserRepository $userRepository)
    {
        $sender_id = $request->input('sender_id');
        $receiver_id = $request->input('receiver_id');
        $amount = $request->input('amount');

        $sender = $userRepository->user($sender_id);
        $receiver = $userRepository->user($receiver_id);

        $makeTransfer = $transferService->makeTransfer($sender, $receiver, $amount);

        
    }
}
