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
            Alert::toast('Invalid credentials', 'errors');
            return back()->withInput()->withErrors(['email' => 'Your provided credentials could not be verified']);
        }

        session()->regenerate();
        $user = auth()->user();

        /** if the user still haven't change the password for the first the first time, user will keep redirected to */
        if(!$user->is_updated)
        {
            Alert::toast('Please update your password for security concerns', 'warning');
            return redirect()->route('user.edit', $user->username);
        }

        /** admin and qa manager redirected to admin panel dashboard */
        if($user->role->role === "Admin" || $user->role->role === "QA Manager"){
            return redirect()->route('home')->with('success', 'Welcome!!');
        }
            
        Alert::toast('Welcome ' . $user->full_name . '!', 'success');
        return redirect()->route('ideas.feed');
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
