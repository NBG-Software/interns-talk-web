<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InternController extends Controller
{
    // Return current mentor's chatrooms to list the interns that has conversation with
    public function chat_interns(){
        $mentor = Auth::user()->mentor;
        $chats = $mentor->chats()->latest('id')->get();

        return view('intern.intern-list', compact('chats'));
    }


    // search specific interns who has conversation with current mentor
    public function search(SearchRequest $request){

        $validated = $request->validated();
        // remove space from fullname
        $search = str_replace(' ', '', $validated['search']);

        // find the users with search name
        $users = User::where('first_name','LIKE',"%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, last_name)"),'like',"%{$search}%")
                    ->pluck('id');

        $mentor = Auth::user()->mentor;

        // then retrieve chats with the matched users that has conversation with current mentor id
        $chats = Chat::where('mentor_id', $mentor->id)
                        ->whereIn('user_id', $users)->get();


        return view('intern.intern-list', compact('chats'));
    }
}


