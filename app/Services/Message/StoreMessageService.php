<?php

namespace App\Services\Message;

use App\Events\MessageStored;
use App\Models\Message;

class StoreMessageService
{
    public function execute(array $data)
    {
        $message = Message::create($data);

        event(MessageStored::broadcast($message));

        return $message ;
    }
}
