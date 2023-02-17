<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        /** username |firstname |lastname |email |password |active |is_updated |department_id |role_id */

        $validatedFields = $request->validate([
            'username' => ['required', Rule::unique('users', 'username'), 'max:50'],
            'firstname' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'email' => ['required', Rule::unique('users', 'email'), 'max:100', 'email'],
            'password' => ['required', 'min:6', 'max:50', 'confirmed'],
        ]);

        $validatedFields['active'] = true;
        $validatedFields['is_updated'] = false;
        /** TODO: update department and role id after other team members completed their crud work */
        $validatedFields['department_id'] = 1;           
        $validatedFields['role_id'] = 1;

        User::create($validatedFields);

        return redirect()->route('home')->with('success', 'User enrolled successfully');
    }
}
