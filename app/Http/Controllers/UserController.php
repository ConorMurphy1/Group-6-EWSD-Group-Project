<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /** User profile */
    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }

    /** update the user password for the first time for security concerns */
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

        Alert::toast('Profile updated successfully', 'success');
        return redirect()->route('profile');
    }

    public function destroy()
    {
        
    }
}