<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mentor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'expertise',
        'company',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A mentor can have many chats.
    public function chats()
    {
        return $this->hasMany(Chat::class, 'mentor_id');
    }

}
