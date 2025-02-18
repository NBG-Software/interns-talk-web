<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MentorCollection;
use App\Models\Mentor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MentorController extends Controller
{
    public function index(Request $request){

        try {
            $user = $request->user();

            $mentors = Mentor::select('user_id')->whereDoesntHave('chats', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

            $mentorlist = User::whereIn('id', $mentors)->get();

            return response()->success($request, new MentorCollection($mentorlist), 'Mentor list', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }

    }
}
