<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        try {
            $validated = $request->validated();

            $email = $validated['email'];
            $password = $validated['password'];

            $credentials = User::where('email', $email)->first();

            if (!is_null($credentials) && Hash::check($password, $credentials->password)) {

                $token = $credentials->createToken($credentials->id)->plainTextToken;

                return response()->success($request, ['token' => $token], 'Login successful', 200);
            } else {

                return response()->error($request, null , 'Email or Password not correct.', 401);
            }
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }
}
