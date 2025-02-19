<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageHistoryRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageCollection;
use App\Jobs\ProcessMessageJob;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index(MessageRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = $request->user();

            $userId = $user->id;
            // $userId = 1;

            $validated['sender_id'] = $userId;

            $message = Message::create($validated);

            // ProcessMessageJob::dispatch($validated['chat_id'], $validated['message_text']);
            broadcast(new MessageSent($message));

            return response()->success($request, ['chat_id' => $validated['chat_id']], 'Message send', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }

    public function show(MessageHistoryRequest $request)
    {
        try{
            $validated = $request->validated();

            $messages = Message::where('chat_id',$validated['chat_id'])->orderBy('created_at', 'desc')->limit(10)->get();

            $messages = $messages->reverse();

            return response()->success($request, new MessageCollection($messages),'Message history list', 200);

        } catch(Exception $e){

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);

        }
    }
}
