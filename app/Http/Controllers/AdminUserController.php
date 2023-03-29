<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    /** Shows all users in table */
    public function index()
    {
        $users = User::where('id', '<>', auth()->id())->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    /** show page to create new user */
    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();

        return view('admin.users.create', compact('departments', 'roles'));
    }

    /** register new user */
    public function store(Request $request)
    {
        /** username |firstname |lastname |email |password |active |is_updated |department_id |role_id */
        $userData = $request->validate([
            'username' => ['required', Rule::unique('users', 'username'), 'max:50'],
            'firstname' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'email' => ['required', Rule::unique('users', 'email'), 'max:100', 'email'],
            'department_id' => ['required'],
            'role_id' => ['required'],
            'password' => ['required', 'min:6', 'max:50', 'confirmed'],
            'image' => [ 'nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ]);

        $registeredDepartment = Department::find($request->input('department_id'));
        $registeredRole = Role::find($request->input('role_id'));
        
        $coordinatorRole = Role::where('role', 'QA Coordinator')->first();

        /** if the register role is not for QA Coordinator check for the existence */
        if($registeredRole->id != $coordinatorRole->id)
        {
            try 
            {
                /** Every department must have at least one QA Coordinator */
                User::where('department_id', $registeredDepartment->id)->where('role_id', $coordinatorRole->id)->firstOrFail();
    
                if($request->file('image') ?? false)
                {
                    $image = $request->file('image');
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        
                    $image->storeAs('public/images', $filename);
                    $userData['image'] = $filename;
                }
        
                /** is_updated column is set to false to ensure the user update their password for the first time */
                $userData['is_updated'] = false;
        
                User::create($userData);
        
                Alert::toast('New user registered successfully', 'success');
                return redirect()->route('admin.users.index');
            } 
            catch(ModelNotFoundException $e) 
            {
                Log::error($registeredRole->role . ' haven\'t register yet for ' . $registeredDepartment->name);
    
                Alert::toast('Register QA Coordinator for the department first', 'warning');
                return back();
            }
        }
        
        if($request->file('image') ?? false)
        {
            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('public/images', $filename);
            $userData['image'] = $filename;
        }

        /** is_updated column is set to false to ensure the user update their password for the first time */
        $userData['is_updated'] = false;

        User::create($userData);

        Alert::toast('New user registered successfully', 'success');
        return redirect()->route('admin.users.index');
    }
    
    /** update specific user account */
    public function edit(Request $request, User $user)
    {
        $departments = Department::all();
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'departments', 'roles'));
    }
    
    public function update(Request $request, User $user)
    {
        $userData = $request->validate([
            'username' => ['required', Rule::unique('users')->ignore($user->id), 'max:50'],
            'firstname' => ['required', 'max:50'],
            'lastname' => ['required', 'max:50'],
            'email' => ['required', Rule::unique('users')->ignore($user->id), 'max:100', 'email'],
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

        $user->update($userData);

        Alert::toast('User account updated!', 'success');
        return redirect()->route('admin.users.index');
    }

    /** remove specific user account */
    public function destroy(User $user)
    {        
        $user->delete();
        
        Alert::toast('User account removed', 'success');
        return redirect()->route('admin.users.index');
    }
}
