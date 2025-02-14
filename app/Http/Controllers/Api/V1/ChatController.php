<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatCollection;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function latestChatList(Request $request)
    {

        try {
            $user = $request->user();

            $chat = Chat::where('user_id', $user->id)->get();

            return response()->success($request, new ChatCollection($chat), 'Retrieve chat list successful', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }
}
