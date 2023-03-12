<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function show()
    {
        return view('users.show', [
            'user' => auth()->user()
        ]);
    }

    public function edit()
    {
        return view('users.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {   
        
        $userData = $request->validate([
            'username' => ['required', Rule::unique('users')->ignore(auth()->id()), 'max:50'],
            'firstname' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'password' => ['required', 'confirmed', 'different:old_password']
        ]);

        if(!Hash::check($request->input('old_password'), auth()->user()->password))
        {
            return back()->withInput()->withErrors(['old_password' => 'Incorrect password']);
        }

        auth()->user()->update($userData);

        return redirect()->route('profile')->with('success', 'Profile Updated Successfully!');
    }

    public function destroy()
    {
        /** soft delete the user account */
        auth()->user()->delete();
        
        return redirect()->route('home')->with('success', 'Account deactivated successfully');
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
            return redirect('/update-password')->with('success', 'Please update your password for security concerns');
        }

        if(auth()->user()->role->role === "Admin"){
            return redirect()->route('home')->with('success', 'Welcome!!');
        }
        else{
            return redirect()->route('ideas.index')->with('success', 'Welcome!!');
        }
    }

    public function logout()
    {
        auth()->logout();

        /** remove all data from a session */
        session()->flush();

        return redirect()->route('login')->with('success', 'Goodbye!');
    }
}
