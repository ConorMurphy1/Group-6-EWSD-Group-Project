<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    public function store(Request $request)
    {
        $newPassword = $request->validate([
            'password' => ['required', 'min:6', 'max:50', 'confirmed'],
        ]);

        /** if user attemps to update the same password */
        if(Hash::check($newPassword['password'], auth()->user()->password))
        {
            return back()->withInput()->withErrors(['password' => 'The password and old password must be different.']);
        }

        /** password is updated for the first time and will not be prompt again in subsequent login */
        $newPassword['is_updated'] = true;

        auth()->user()->update($newPassword);

        Alert::toast('Password changed successfully', 'success');
        return redirect()->route('user.profile', auth()->user()->username);
    }
}
