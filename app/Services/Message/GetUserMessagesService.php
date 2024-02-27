<?php

namespace App\Services\Message;

use App\Models\Message;
use Illuminate\Support\Arr;

class GetUserMessagesService
{
    public function execute(array $data)
    {
        return Message::query()
            ->betweenUsers(Arr::get($data,'first_user_id'),Arr::get($data,'second_user_id'))
            ->get();

    }
}
