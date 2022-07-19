<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // // use AuthenticatesUsers;
    // // protected $redirectTo = RouteServiceProvider::HOME;
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function login() {
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        // if(Auth::attempt($request->only('user_email','password'))){
        //     return redirect('/');
        // }
        // return redirect('login');
        // $remember = isset($request->remember) ? true : false;

        $request->validate([
            'user_email' => 'required|email',
            'password' => 'required|min:8',

        ],[
            'user_email.required' => "Tài khoản email bắt buộc phải nhập",
            'user_email.email' => "Tài khoản email không đúng định dạng",
            'password.required' => "Mật khẩu bắt buộc phải nhập",
            'password.min' => "Mật khẩu phải có 8 kí tự trở lên",

        ]);

        if (Auth::attempt([
            'user_email' => $request->user_email,
            'password'=>$request->password,
            'deleted_at'=>null,
        ], $request->remember)){
            $request->session()->regenerate();

            return redirect()->route('master');
        }

        Session::flash('error','Email hoặc mật khẩu không chính xác');
        return redirect()->back()->with('msg','Email hoặc mật khẩu không chính xác');;
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
