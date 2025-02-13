<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function __invoke(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        $status = Password::reset($validated,function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        });

        if($status === Password::PASSWORD_RESET){
            return response()->success($request, null, 'Password reset successful!', 200);
        }

        return response()->error($request, null, 'Invalid token or email.',400);
    }
}
