<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'Admin';
    protected $redirectAfterlogout = '/login';

    public function getLoginform()
    {
        if (Auth::guard('Admin')->check()) {
            return redirect()->route('index');
        } else {
            return view('auth.login');
        }
    }

    public function postLogin(Request $request)
    {
        $loginField = $request->get('login');
        $password = $request->get('password');

        $usernameCredentials = [
            'name' => $loginField,
            'password' => $password,
        ];

        $emailCredentials = [
            'email' => $loginField,
            'password' => $password,
        ];

        $validation = Auth::guard('Admin')->attempt($usernameCredentials) || Auth::guard('Admin')->attempt($emailCredentials);

        if ($validation) {
            return redirect()->route('index')->with('loginSuccess_msg', 'Login successful.');
        } else {
            return redirect()->route('getLoginForm')
                ->withErrors(['login' => 'Invalid username or password.'])
                ->withInput();
        }
    }
    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect('admin-backend/login');
    }
}
