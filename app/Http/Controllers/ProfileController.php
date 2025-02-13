<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateValidationRequest;
use App\Http\Requests\updateProfileImageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProfileController extends Controller
{

    public function show()
    {
        $user = User::where('id', Auth::id())->where('role','mentor')->firstOrFail();
        return view('profile.show_profile', compact('user'));
    }

    public function update(ProfileUpdateValidationRequest $request, $id)
    {

        $user =  User::where('id', $id)->where('role','mentor')->firstOrFail();;

        // seperating full name
        $first_name = Str::of($request->name)->beforeLast(' ');
        $last_name = Str::of($request->name)->afterLast(' ');

        $user->update([
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $request->email,
        ]);

        if ($user->mentor) {
            $user->mentor->update([
                'expertise' => $request->expertise,
                'company'   => $request->company,
            ]);
        }

        return redirect()->route('profile.show');
    }

    public function update_img(updateProfileImageRequest $request, $id)
    {
        $user =  User::where('id', $id)->where('role','mentor')->firstOrFail();

        if ($request->hasFile('profile_picture')) {
            $newName = uniqid() . '_' . "profile_picture" . '.' . $request->file('profile_picture')->extension();
            $request->file('profile_picture')->storeAs('profile_pictures', $newName);

            $user->update([
                'profile_picture' => $newName,
            ]);
        }

        return redirect()->route('profile.show');
    }
}
