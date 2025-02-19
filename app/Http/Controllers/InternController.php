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
    public function chat_interns(){
        $mentor = Auth::user()->mentor;
        $chats = $mentor->chats;

        return view('intern.intern-list', compact('chats'));
    }


    public function search(SearchRequest $request){

        $validated = $request->validated();
        $search = str_replace(' ', '', $validated['search']);

        $users = User::where('first_name','LIKE',"%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, last_name)"),'like',"%{$search}%")
                    ->pluck('id');

        $mentor = Auth::user()->mentor;

        $chats = Chat::where('mentor_id', $mentor->id)
                        ->whereIn('user_id', $users)->get();

        // $interns = User::internSearch($validated['search'])->orderBy('created_at','desc')->paginate(10);

        return view('intern.intern-list', compact('chats'));
    }
}


