<?php

namespace App\Http\Controllers;

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


}


