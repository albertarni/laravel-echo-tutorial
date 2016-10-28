<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }
}