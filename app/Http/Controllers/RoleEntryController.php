<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleData = role::all();
        return view('role.roleEntry',['roleMembers'=>$roleData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $roles = new role();
        $roles->role = $request->role;
        $roles->created_at = now();
        $roles->updated_at = now();  
        $roles->save();

        Alert::toast('Role created successfully', 'success');
        return redirect('admin\role')->with('success', 'Role created successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roleData = role::find($id);
        return view('role.updateRole',['roleMembers'=>$roleData]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $roleData = role::find($id);
        return view('role.updateRole',['roleMembers'=>$roleData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roles = role::find($id);
        $roles->role = $request->input('roleUpdate');
        $roles->updated_at = now();  
        $roles->save();
    
        return redirect('admin\role')->with('success', 'Idea created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roleData = role::findOrFail($id);
        $roleData->delete();
        Alert::toast('You have successfully deleted a Role called '. $roleData->role .' ', 'success');
        return back();
    }
}
