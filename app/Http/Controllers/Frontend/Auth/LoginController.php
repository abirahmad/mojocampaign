<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('user.ranking');
        }
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        //Validate the form data
        $request->validate([
            'phone_no'         => 'required'
        ]);

        //Attempt to log the employee in
        if (Auth::guard('web')->attempt(['phone_no' => $request->phone_no, 'password' => $request->phone_no, 'is_approved' => 0], $request->remember)) {
            //If successful then redirect to the intended location
            session()->flash('login_success', 'Successfully Logged In');
            return redirect()->intended(route('user.quizes.index'));
        } else {
            //If unsuccessfull, then redirect to the admin login with the data
            Session::flash('login_error', "Invalid phone number !");
            return redirect()->back()->withInput($request->only('phone_no', 'remember'));
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }
}
