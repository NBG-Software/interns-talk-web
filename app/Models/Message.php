<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    // A message is sent by a user.
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
