<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['role'] = 'intern';

            $user = new User($validated);

            $user->save();

            $token = $user->createToken($user->id)->plainTextToken;

            return response()->success($request,['token' => $token], 'Registration successful', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }
}
