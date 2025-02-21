<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function fetch_messages($id){
        $chat = Chat::with('messages')->where('id', $id)->first();
        if(!Gate::allows('permit-chat', $chat)){
            abort(403, 'Unauthorized');
        };

        $messages = $chat->messages()
                            ->get()
                            ->groupBy(function ($message) {
                                return date('Y-m-d', strtotime($message->created_at));
                            });
        return view('intern.intern-talk', compact('chat', 'messages'));
    }

    public function store_message(Request $request, $id){
        $chat = Chat::findOrFail($id);
        // abort if the current user is not chat mentor
        if(!Gate::allows('permit-chat', $chat)){
            abort(403, 'Unauthorized');
        };

        $validator = Validator::make($request->all(), [
            'message_text' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $message = Message::create([
            'chat_id' => $id,
            'sender_id' => Auth::user()->mentor->id,
            'message_text' => $request->message_text,
        ]);

        broadcast(new MessageSent($message));

        return response()->json(['message' => $message, 'chat' => $chat]);
    }


    public function store_media(Request $request, $id){
        $chat = Chat::findOrFail($id);
        // abort if the current user is not chat mentor
        if(!Gate::allows('permit-chat', $chat)){
            abort(403, 'Unauthorized');
        };

        $validator = Validator::make($request->all(), [
            'message_media' => 'required|file|mimes:png,jpg,jpeg|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }


        $newName = null;
        if ($request->hasFile('message_media')) {
            $newName = uniqid() . '_' . "message_media" . '.' . $request->file('message_media')->extension();
            $request->file('message_media')->storeAs('message_media', $newName);

        }

        $message = Message::create([
            'chat_id' => $id,
            'sender_id' => Auth::user()->mentor->id,
            'message_media' => $newName,
        ]);

        broadcast(new MessageSent($message));


        return response()->json(['message' => $message, 'chat' => $chat]);
    }

}
