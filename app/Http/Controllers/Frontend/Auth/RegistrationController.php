<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Session;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use RegistersUsers;

    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('user.ranking');
        }
        return view('frontend.auth.registration');
    }

    public function registration(Request $request)
    {
        $this->validate(
            $request,
            [
                'first_name' => 'required',
                'phone_no' => 'required|min:11|max:11|unique:users',
                'dob' => 'required',
                'location' => 'required',
            ],
            [
                'first_name.required' => 'Please give your first name',
                'phone_no.required' => 'Please give your phone number',
                'phone_no.unique' => 'Phone number already registered. If you have an account, Please Login',
                'dob.required' => 'Please give your date of birth',
                'location.required' => 'Please give your location',
            ]
        );

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => '',
            'username' => StringHelper::createSlug($request->first_name, 'User', 'username', ''),
            'phone_no' => $request->phone_no,
            'date_of_birth' => $request->dob,
            'location' => $request->location,
            'password' => Hash::make($request->phone_no),
        ]);

        if ($user) {
            session()->flash('registration_success', 'Your registration is successful ! Please login to continue.');
            return redirect()->intended(route('user.login'));
        } else {
            session()->flash('registration_error', 'Error Registration! Please fill all inputs.');
            return redirect()->back();
        }
    }
}
