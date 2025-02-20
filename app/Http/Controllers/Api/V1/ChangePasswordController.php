<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ChangePasswordController extends Controller
{
    public function __invoke(ChangePasswordRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = $request->user();

            if (!Hash::check($validated['old_password'], $user->password)) {
                return response()->error($request, null, "Password invalid", 422);
            }

            $user->password = $validated['new_password'];

            $user->save();

            return response()->success($request, null, "Password update successful", 200);
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, "Internal server error", 500);
        }
    }
}
