<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/intern/list';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'profile_picture' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'expertise' => ['required', 'string'],
            'company' => ['required', 'string'],
            'base64_image' => ['nullable'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $newName = '';
        if (isset($data['profile_picture'])) {
            $newName = uniqid() . '_' . "profile_picture" . '.' . $data['profile_picture']->extension();
            $data['profile_picture']->storeAs('profile_pictures', $newName);
        } elseif (!empty($data['base64_image'])) {
            $image = $data['base64_image'];
            $image = preg_replace('/^data:image\/\w+;base64,/', '', $image); // Remove metadata
            $image = str_replace(' ', '+', $image);
            $imageData = base64_decode($image);

            $matches = [];
            if (preg_match('/^data:image\/(\w+);base64,/', $data['base64_image'], $matches)) {
                $extension = $matches[1]; // This will be "png", "jpeg", "jpg", etc.
            } else {
                // Default to "png" if no match is found (could add error handling)
                $extension = 'png';
            }

            // Create a unique filename based on the extension
            $newName = uniqid() . '_profile_picture.' . $extension;

            // Store the image in the storage
            Storage::put('profile_pictures/' . $newName, $imageData);
        };



        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'mentor',
            'profile_picture' => $newName,
        ]);

        if ($user) {
            $this->create_mentor($data, $user);
        }

        return $user;
    }

    public function create_mentor(array $data, $user)
    {
        Mentor::create([
            'user_id' => $user->id,
            'expertise' => $data['expertise'],
            'company' => $data['company'],
        ]);
    }
}
