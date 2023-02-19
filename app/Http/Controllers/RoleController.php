<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    function show()
    {
        $roleData = role::all();
        return view('roleEntry',['roleMembers'=>$roleData]);
    }
    function AddRole(Request $req)
    {
        $roles = new role();
        $roles->role = $req->role;
        $roles->created_at = now();
        $roles->updated_at = now();  
        $roles->save();
        return redirect('role');

    }
    function deleteRole($roleId)
    {
        $roleData = role::find($roleId);
        $roleData->delete();
        return redirect('role')->with('success', 'Role deleted successfully.');

    }
    function showdata($roleId)
    {
        $roleData = role::find($roleId);
        return view('updateRole',['roleMembers'=>$roleData]);
    }
    function updateRole(Request $req, $roleId)
    {
        $roles = role::find($roleId);
        $roles->role = $req->input('roleUpdate');
        $roles->updated_at = now();  
        $roles->save();
        return redirect('role');

    }

}
