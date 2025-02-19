<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messages($id){

        $chat = Chat::findOrFail($id);

        $messages = Message::where('chat_id', $id)
                            ->get()
                            ->groupBy(function ($message) {
                                return date('Y-m-d', strtotime($message->created_at));
                            })
                            ->toArray();

        // return response()->json(['messages' => $messages, 'chat' => $chat]);

        return view('intern.intern-talk', compact('messages'));

    }
}
