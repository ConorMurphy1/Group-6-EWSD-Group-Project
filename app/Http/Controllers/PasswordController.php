<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function create()
    {
        return view('register.update-password');
    }

    public function store(Request $request)
    {
        $newPassword = $request->validate([
            'password' => ['required', 'confirmed']
        ]);

        /** password is updated for the first time and will not be prompt again in subsequent login */
        $newPassword['is_updated'] = true;

        auth()->user()->update($newPassword);

        return redirect()->route('home')->with('success', 'Password updated!');
    }
}
