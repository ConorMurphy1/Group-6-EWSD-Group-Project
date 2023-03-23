<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

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

        Alert::toast('Profile updated successfully', 'success');
        return redirect()->route('profile');
    }

}