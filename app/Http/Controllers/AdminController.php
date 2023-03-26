<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadTrait;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    use UploadTrait;

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        $departments = Department::all();
        $roles = Role::all();

        return view('admin.edit', compact('user', 'departments', 'roles'));
    }

    public function update(Request $request)
    {
        $admin = auth()->user();

        $userData = $request->validate([
            'username' => ['required', Rule::unique('users')->ignore($admin->id), 'max:50'],
            'firstname' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'email' => ['required', Rule::unique('users')->ignore($admin->id), 'max:100', 'email'],
            'department_id' => ['required'],
            'role_id' => ['required'],
            'image' => [ 'nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ]);

        if($request->file('image') ?? false)
        {
            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('public/images', $filename);
            $userData['image'] = $filename;
        }

        $admin->update($userData);

        Alert::toast('User account updated!', 'success');
        return redirect()->route('admin.users.index');
    }

    public function destroy()
    {
        auth()->user()->delete();
        return redirect()->route('admin.users.index');
    }
}
