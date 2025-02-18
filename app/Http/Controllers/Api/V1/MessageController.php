<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Jobs\ProcessMessageJob;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(MessageRequest $request)
    {
        $validated = $request->validated();

        $user = $request->user();

        $userId = $user->id;
        // $userId = 1;

        $validated['sender_id'] = $userId;

        Message::create($validated);

        // ProcessMessageJob::dispatch($validated['chat_id'], $validated['message_text']);
        broadcast(new MessageSent($validated['chat_id'],$validated['message_text']));

        return response()->success($request, ['chat_id' => $validated['chat_id']], 'Message send', 200);
    }
}
