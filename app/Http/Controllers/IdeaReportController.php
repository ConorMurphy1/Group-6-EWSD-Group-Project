<?php

namespace App\Http\Controllers;

use App\Models\{Idea, Department, Event};
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class IdeaReportController extends Controller
{
    public function index(Request $request)
    {

        $eventId = $request->input('event');
        $successMessage = Session::get('success');
        // dd(Session::get('success'));

        if ($eventId) 
        {

            $ideasPerDept = Idea::selectRaw('department_id, count(*) as dep_idea_count')
                ->where('event_id', $eventId)
                ->groupBy('department_id')
                ->get();

            $usersPerDept1 = Idea::selectRaw('department_id, COUNT( user_id) AS user_count')
                                ->where('event_id', $eventId)
                                ->groupBy('department_id')
                                ->get();
            

            $departments = Department::all();

            $totalIdeas = $ideasPerDept->sum('dep_idea_count');

            $departmentNames = $departments->pluck('name')->toArray();

            $ideaCountPerDept = $departments->map(function ($dept) use ($ideasPerDept) {
                $ideaCount = $ideasPerDept->where('department_id', $dept->id)->first();
                $status = $dept->name;
                $yValue = $ideaCount ? $ideaCount->dep_idea_count : 0;
                return ['x' => 0, 'y' => $yValue, 'value' => $yValue, 'status' => $status];
            })->toArray();

            $totalCount = Idea::where('event_id', $eventId)->count();

            $deaptIdeaPercent = $departments->map(function ($dept) use ($ideasPerDept, $totalCount) {
                $ideaCount = $ideasPerDept->where('department_id', $dept->id)->first();
                $percentage = $totalCount > 0 ? ($ideaCount ? $ideaCount->dep_idea_count / $totalCount * 100 : 0) : 0;
                $department = $dept->name;
                $value = round($percentage, 1) . '%';
                return ['x' => 0, 'y' => $percentage, 'value' => $value, 'status' => $department];
            });



            $contributorsPerDepartment1 = $departments->map(function ($dept) use ($usersPerDept1) {
                $userCount = $usersPerDept1->where('department_id', $dept->id)->first()->user_count ?? 0;
                $department = $dept->name;
                return ['x' => 0, 'y' => $userCount, 'value' => $userCount, 'status' => $department];
            })->toArray();
            
            
            


            return view('report.index')->with('departmentsArray', $departmentNames)
                ->with('ideaCountArray', $ideaCountPerDept)
                ->with('idea_Department_Percentage', $deaptIdeaPercent)
                ->with('usersPerDept', $contributorsPerDepartment1);
        } 
        else {

            
            $ideasPerDept = Idea::selectRaw('department_id, count(*) as dep_idea_count')
                ->groupBy('department_id')
                ->get();

            $usersPerDept = Idea::selectRaw('department_id, COUNT(user_id) AS user_count')
                ->groupBy('department_id')
                ->get();

            $departments = Department::all();

            $totalIdeas = $ideasPerDept->sum('dep_idea_count');

            $departmentNames = $departments->pluck('name')->toArray();

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



            $contributorsPerDepartment = $departments->map(function ($dept) use ($usersPerDept) {
                $userCount = $usersPerDept->where('department_id', $dept->id)->first()->user_count ?? 0;
                $department = $dept->name;
                return ['x' => 0, 'y' => $userCount, 'value' => $userCount, 'status' => $department];
            })->toArray();


            return view('report.index')->with('departmentsArray', $departmentNames)
                ->with('ideaCountArray', $ideaCountPerDept)
                ->with('idea_Department_Percentage', $deaptIdeaPercent)
                ->with('usersPerDept', $contributorsPerDepartment);
        }
    }
}
