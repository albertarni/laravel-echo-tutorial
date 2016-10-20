<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendChatMessage extends Command
{
    protected $signature   = 'chat:message {message}';
    protected $description = 'Send chat message.';

    public function handle()
    {
        // Fire off an event, just randomly grabbing the first user for now
        $user    = \App\User::find(2);
        $from_user    = \App\User::find(3);
//        $message = \App\ChatMessage::create([
//                'user_id' => $user->id,
//                'message' => $this->argument('message')
//        ]);


        $user->notify(new \App\Notifications\WorkoutAssigned($from_user->name, $this->argument('message')));
//        event(new \App\Events\ChatMessageWasReceived($this->argument('message'), $user));
    }
}