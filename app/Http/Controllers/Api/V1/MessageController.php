<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Jobs\ProcessMessageJob;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(MessageRequest $request)
    {
        $validated = $request->validated();

        // $user = $request->user();

        // $userId = $user->id;
        $userId = 1;

        $validated['sender_id'] = $userId;

        $messageModel = Message::create($validated);

        ProcessMessageJob::dispatch($messageModel->id, $validated['message_text']);

        return response()->success($request, null, 'Message send', 200);
    }
}
