<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
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

        /** if the user still haven't change the password for the password, user will keep redirected to */
        if(!auth()->user()->is_updated)
        {
            return redirect('/update-password')->with('success', 'Please update your password for security concerns');
        }

        return redirect()->route('home')->with('success', 'Welcome!!');
    }

    public function logout()
    {
        auth()->logout();

        /** remove all data from a session */
        session()->flush();

        return redirect()->route('home')->with('success', 'Goodbye!');
    }
}
