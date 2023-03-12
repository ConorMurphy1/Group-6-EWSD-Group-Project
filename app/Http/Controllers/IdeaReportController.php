<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Department;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IdeaReportController extends Controller
{
    public function index(){

        $ideasPerDept = Idea::selectRaw('department_id, count(*) as dep_idea_count')
                    ->groupBy('department_id')
                    ->get();

        $usersPerDept = Idea::selectRaw('department_id, COUNT(user_id) AS user_count')
                        ->groupBy('department_id')
                        ->get();

        $departments = Department::all();

        $totalIdeas = $ideasPerDept->sum('dep_idea_count');

        $departmentNames = $departments->pluck('name')->toArray();
        $departmentNames1 = $departments->pluck('name')->toArray();

        $ideaCountPerDept = $departments->map(function ($dept) use ($ideasPerDept) {
            $ideaCount = $ideasPerDept->where('department_id', $dept->id)->first();
            $status = $dept->name;
            $yValue = $ideaCount ? $ideaCount->dep_idea_count : 0;
            return ['x' => 0, 'y' => $yValue, 'value' => $yValue, 'status' => $status];
        })->toArray();
        

        $deaptIdeaPercent = $departments->map(function ($dept) use ($ideasPerDept) {
            $ideaCount = $ideasPerDept->where('department_id', $dept->id)->first();
            $totalCount = Idea::count();
            $percentage = $totalCount > 0 ? ($ideaCount ? $ideaCount->dep_idea_count / $totalCount * 100 : 0) : 0;
           
            $department = $dept->name;
            $value = round($percentage, 1) . '%';
            return ['x' => 0, 'y' => $percentage, 'value' => $value, 'status' => $department];

        });
    
       

        $contributorsPerDepartment = $usersPerDept->map(function ($dept) use ($departments) {
            $deptName = $departments->where('id', $dept->department_id)->first()->name;
            return ['x' => 0, 'y' => $dept->user_count, 'value' => $dept->user_count, 'status' => $deptName];
        })->toArray();
    

        return view('report.index')->with('departmentsArray', $departmentNames)
                                    ->with('departmentsArray1', $departmentNames1)
                                    ->with('ideaCountArray', $ideaCountPerDept)
                                    ->with('idea_Department_Percentage', $deaptIdeaPercent)
                                    ->with('usersPerDept', $contributorsPerDepartment);

        
    }
}
