<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MentorController extends Controller
{
    public function index(Request $request){

        try {

            $user = $request->user();

            $talkedMentorList = 0;
            $mentor = 0;


        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }

    }
}
