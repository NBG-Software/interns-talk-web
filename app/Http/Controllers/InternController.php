<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InternController extends Controller
{
    public function index(){
        $interns = User::where('role', 'intern')->paginate(5);
        return view('intern-list-table', compact('interns'));
    }
}
