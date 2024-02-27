<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\getMessagesRequest;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\SuccessResource;
use App\Services\Message\GetUserMessagesService;
use App\Services\Message\StoreMessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request,StoreMessageService $messageService)
    {
        return SuccessResource::make([
            'message' => MessageResource::make(
                $messageService->execute(
                    $request->validated()+ ['sender_id' => auth()->id()]
                )
            )
        ]);
    }

    public function index(getMessagesRequest $getMessagesRequest, GetUserMessagesService $messagesService)
    {
        return SuccessResource::make([
            'messages' => MessageResource::collection(
                $messagesService->execute($getMessagesRequest->validated() + ['first_user_id' => auth()->id()]))
        ]);
    }
}
