<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class ProfileUploadController extends Controller
{
    public function profileUpload(UserProfileUpload $request)
    {
        try {
            $user = $request->user();

            if(!is_null($user->profile_picture)){

                Storage::disk('public')->delete($user->profile_picture);

            }

            $imagePath = Storage::disk('public')->put('profile_pictures', $request->profile_picture);

            $user->profile_picture = $imagePath;

            $user->save();

            return response()->success($request, null, 'Profile upload successful', 200);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }
}
