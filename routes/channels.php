<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat-channel-{chatId}', function ($user, $chatId) {
    return \App\Models\Chat::where('id', $chatId)
        ->where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->orWhere('mentor_id', $user->mentor->id);
        })
        ->exists();

});
