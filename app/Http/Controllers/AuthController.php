<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginShow () {
        if (Auth::check()){
            return redirect('/home');
        }
        else {
            return view ('login');
        }
    }

    public function loginAuthentication (Request $request) {
        $remember = $request->has('rememberMe') ? true : false;

        $validateData = $request->validate([
            'emailAddress' => 'required|email',
            'passwords' => 'required|min:8|max:20',
        ],
        [
            'emailAddress.required' => 'The email field is required.',
            'emailAddress.email' => 'The email must be in email format',
            'passwords.required' => 'The password field is required',
            'passwords.min' => 'The minimum length of password field is 8 characters.',
            'passwords.max' => 'The maximum length of password field is 20 characters.'
        ]);

        if (Auth::attempt(['email' => $request->emailAddress, 'password' => $request->passwords], $remember)){
            return redirect('/home');
        }
        else if (is_null(User::where('email',$request->emailAddress)->first())){
            return redirect('/login')->withErrors(['msg' => 'Your account is not found!'])->withInput();
        }
        else{
            return redirect('/login')->withErrors(['msg' => 'Your password is incorrect!'])->withInput();
        }
    }

    public function registerShow () {
        if (Auth::check()){
            return redirect('/home');
        }
        else {
            return view ('register');
        }
    }

    public function registerAuthentication (Request $request) {
        $validateData = $request->validate([
            'fullname' => 'required',
            'emailAddress' => 'required|email|unique:users,email',
            'passwords' => 'required|min:8|max:20',
            'confirmPassword' => 'required|same:passwords',
            'termsAndConditions' => 'required'
        ],
        [
            'emailAddress.required' => 'The email field is required.',
            'emailAddress.email' => 'The email field must be in email format',
            'emailAddress.unique' => 'The email field must be unique',
            'passwords.required' => 'The password field is required',
            'passwords.min' => 'The minimum length of password field is 8 characters.',
            'passwords.max' => 'The maximum length of password field is 20 characters.',
            'confirmPassword.required' => 'The confirm password field is required',
            'confirmPassword.same' => 'The confirm password is not same with the password.',
            'termsAndConditions.required' => 'Terms and Conditions must be checked.'
        ]);
        
        User::create([
            'fullname' => $request->fullname,
            'email' => $request->emailAddress,
            'password' => bcrypt($request->passwords),
            'role_id' => 1,
            'profile_picture' => 'default_user_image.png'
        ]);

        return redirect('/login')->withInput();
    }

    public function logout (Request $request){
        Auth::logout();
        return redirect('/login');
    }
}
