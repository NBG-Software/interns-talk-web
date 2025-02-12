<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
     // A mentor belongs to one user.
     public function user()
     {
         return $this->belongsTo(User::class);
     }

     // A mentor can have many chats.
     public function chats()
     {
         return $this->hasMany(Chat::class);
     }
}
