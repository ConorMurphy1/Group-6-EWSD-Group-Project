<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SessionController extends Controller
{
    public function create()
    {
        return view('sessions.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!auth()->attempt($credentials))
        {
            return back()->withInput()->withErrors(['email' => 'Your prvoided credentials could not be verified']);
        }

        session()->regenerate();

        /** if the user still haven't change the password for the first the first time, user will keep redirected to */
        if(!auth()->user()->is_updated)
        {
            Alert::toast('Please update your password for security concerns', 'warning');
            return redirect()->route('password.create');
        }

        if(auth()->user()->role->role === "Admin"){
            return redirect()->route('home')->with('success', 'Welcome!!');
        }
            
        return redirect()->route('ideas.index')->with('success', 'Welcome!!');
    }

    public function logout()
    {
        auth()->logout();

        /** remove all data from a session */
        session()->flush();

        Alert::toast('See you again soon!', 'success');
        return redirect()->route('login')->with('success', 'Goodbye!');
    }
}
