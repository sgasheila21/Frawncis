<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ProfileController extends Controller
{
    public function profileShow () {
        return view('profile');
    }

    public function profileStore (Request $request) {
        $user = User::find(auth()->user()->id);

        if ($request->has('profilePicture') || auth()->user()->profile_picture == 'default_user_image.png'){
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.auth()->user()->id,
                'profilePicture' => 'required|max:10240|mimes:jpg,jpeg,png'
            ], [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.email' => 'The email field must be in email format',
                'email.unique' => 'The email field must be unique',
                'profilePicture.required' => 'The profile picture field is required.',
                'profilePicture.max' => 'Maximum file size for profile picture is 10MB.',
                'profilePicture.mimes' => 'Profile picture must be in the format of either .jpg, .jpeg. or .png.'
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator, 'submitProfile');
            }

            $extFile = $request->profilePicture->getClientOriginalExtension();
            $namaFile = auth()->user()->fullname.".".$extFile;
            $path = $request->profilePicture->move('image',$namaFile);
    
            $user->profile_picture = $namaFile;
        }
        else{
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.auth()->user()->id
            ], [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.email' => 'The email field must be in email format',
                'email.unique' => 'The email field must be unique'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator, 'submitProfile');
            }
        }

        $user->fullname = $request->name;
        $user->email = $request->email;
        $user->save();

        if($user->wasChanged()){
            return redirect('/profile')->with('success', 'Profile successfully updated!');
        }
        else{
            return redirect('/profile')->with('failure', 'Nothing changed!');
        }
    }

    public function changePassword (Request $request) {
        $user = User::find(auth()->user()->id);

        $validator = FacadesValidator::make($request->all(), [
            'password' => ['required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Your current password is incorrect.');
                    }
                },
            ],
            'newPassword' => 'required|min:8|max:20',
            'reNewPassword' => 'required|same:newPassword'
        ], [
            'password.required' => 'The current password field must be filled.',
            'newPassword.required' => 'The new password field must be filled.',
            'newPassword.min' => 'The minimum length of new password field is 8 characters.',
            'newPassword.max' => 'The maximum length of new password field is 20 characters.',
            'reNewPassword.required' => 'The re-enter new password field must be filled.',
            'reNewPassword.same' => 'The re-enter password is not same with the new password.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'changePasswordErrors');
        }

        $user->password = bcrypt($request->newPassword);
        $user->save();

        if($user->wasChanged()){
            return redirect('/profile')->with('success', 'Your password has been changed!');
        }
        else{
            return redirect('/profile')->with('failure', 'Nothing changed!');
        }   
    }
}