<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDepartments()
    {
        $departments = Department::all();

        return view ('departments.show-create', compact('departments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addDepartment(Request $request)
    {
        $request->validate([
            'name' => ['required|max:30',Rule::unique('departments')]
        ]);

        Department::create([
            'name' => $request->department_name
        ]);

        return redirect('departments')->with('successAlert','New Department Added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function editDepartment(string $id)
    {
        $department = Department::find($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function updateDepartment(Request $request, string $id)
    {

        $request->validate([
            'name' => ['required|max:30',Rule::unique('departments')]
        ]);

        Department::find($id)->update([
            'name' => $request->department_name,
            'updated_at' => now()
        ]);

        return redirect('departments')->with('successAlert', 'Department Name Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function deleteDepartment(Department $department, $id)
    {
        Department::find($id)->delete();

        return redirect('departments')->with('successAlert', 'Department deleted successfully!');
    }
}
