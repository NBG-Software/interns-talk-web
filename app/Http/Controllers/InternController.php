<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InternController extends Controller
{
    public function index(){
        $interns = User::where('role', 'intern')->paginate(10);
        return view('intern.intern-list', compact('interns'));
    }

    public function talk($id){
        $intern = User::where('id', $id)
                        ->where('role', 'intern')
                        ->first();
        return view('intern.intern-talk', compact('intern'));
    }
}


