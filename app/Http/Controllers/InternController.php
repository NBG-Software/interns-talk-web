<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternController extends Controller
{
    public function chat_interns(){
        $mentor = Auth::user()->mentor;
        $chats = $mentor->chats;

        return view('intern.intern-list', compact('chats'));
    }


    public function search(SearchRequest $request){

        $validated = $request->validated();

        $interns = User::internSearch($validated['search'])->orderBy('created_at','desc')->paginate(10);

        return view('intern.intern-list', compact('interns'));
    }
}


