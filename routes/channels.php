<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat-channel-{chatId}', function ($user, $chatId) {
    return Chat::where('id', $chatId)
    ->where(function ($query) use ($user) {
        $query->where('mentor_id', $user->id)
              ->orWhere('user_id', $user->id);
    })
    ->exists();
});
