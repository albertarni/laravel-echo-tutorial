<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\ChatMessage;

class ChatController extends Controller
{
    public function getMessages()
    {
        $user = Auth::user();

        dd($user->chatRooms);
    }
}
