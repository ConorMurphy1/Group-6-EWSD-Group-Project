<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /** User profile */
    public function profile(User $user)
    {
        $ideas = Idea::where('user_id', $user->id)->latest()->get();

        return view('users.show', compact('user', 'ideas'));
    }

    /** another user checks the user profile */
    public function show(Request $request)
    {
        $username = $request->query('username');
        $user = User::where('username', $username)->first();
        
        $ideas = Idea::where('user_id', $user->id)->latest()->get();

        return view('users.show', compact('user', 'ideas'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /** update the user password for the first time for security concerns */
    public function update(Request $request, User $user)
    {   
        $userData = $request->validate([
            'username' => ['required', Rule::unique('users')->ignore(auth()->id()), 'max:50'],
            'firstname' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
        ]);

        $user->update($userData);

        Alert::toast('Profile updated successfully', 'success');
        return redirect()->route('user.profile', $user->username);
    }
}

