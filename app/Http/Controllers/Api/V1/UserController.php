<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {

        try {
            $user = $request->user();

            return response()->success($request, new UserResource($user), 'User retrieve successful', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }

    public function edit(UserEditRequest $request)
    {

        try {
            $user = $request->user();

            $validated = $request->validated();

            $user->update($validated);

            return response()->success($request, new UserResource($user), 'User retrieve successful', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }

}
