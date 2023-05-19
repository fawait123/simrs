<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);


        $user = \App\Models\User::where('email',$request->email)->first();

        if(!$user){
            return redirect()->back()->withErrors(['email'=>'The credentials doesnt match to our record']);
        }

        if(!Hash::check($request->password,$user->password)){
            return redirect()->back()->withErrors(['email'=>'The credentials doesnt match to our record']);
        }

        if($user->is_verified == 0){
            return redirect()->back()->withErrors(['email'=>'Account is not verified']);
        }

        auth()->login($user);

        return redirect()->route('home');

    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerAction(Request $request)
    {
        $request->validate([
            'email'=>'required|unique:users,email',
            'name'=>'required',
            'password'=>'required|confirmed',
        ]);

        $user = \App\Models\User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'role'=>'user',
            'prefixID'=>null,
            'prefix'=>'App\Models\Identity',
            'is_verified'=>0
        ]);

        event(new \App\Events\RegistrationEvent($user));

        return redirect()->route('login')->withErrors(['email'=>'Account creaated, please wait admin to approve your account']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
