<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    // A chat belongs to one mentor.
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    // A chat belongs to one user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A chat can have many messages.
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
