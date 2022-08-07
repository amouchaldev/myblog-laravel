<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }
    public function loginHandle(Request $request) 
    {   
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            if ($user->password == $request->input('password')) {
                session()->put('loginEmail', $request->input('email'));
                return redirect()->route('posts');
            }
            else {
                return back()->with('fail', 'Invalid Email Or Password');
            }
        }
        else {
            // return 'hi';
            return back()->with('fail', 'Invalid Email Or Password');
        }
    }
    public function dashboard() {
        return view('auth.dashboard', ['user' => User::where('email', session()->get('loginEmail'))->first()]);
    }
    public function logout() {
        if (session()->has('loginEmail')) {
            session()->pull('loginEmail');
            return redirect()->route('login');
        }
    }

}
