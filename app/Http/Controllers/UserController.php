<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            if (Hash::check($request->input('password'), $user->password)) {
                session()->put('loginEmail', $request->input('email'));
                session()->put('loginFirstName', $user->firstName);
                session()->put('loginRole', $user->role);
                return redirect()->route('posts');
            }
            else {
                return back()->with('fail', 'Invalid Email Or Password');
            }
        }
        else {
            return back()->with('fail', 'Invalid Email Or Password');
        }
    }

    public function logout() {
        if (session()->has('loginEmail')) {
            session()->pull('loginEmail');
            return redirect()->route('login');
        }
    }

    // add user view
    public function create() {
        return view('auth.create');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'email|unique:users',
            'password' => 'min:8',
        ]);
        $user = new User($request->except(['_token', 'password']));
        $user->password = Hash::make($request->input('password'));
        if ($user->save()) {
            return back()->with('success', "$request->firstName Added Successfully As $request->role");
        }
    }
    
}
