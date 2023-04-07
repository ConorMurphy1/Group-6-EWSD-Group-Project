<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Department;
use App\Models\User;
use App\Models\Event;
use App\Models\Comment;
use Illuminate\Http\Request;

class reportQACoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eventId = $request->input('event');

        $user = auth()->user();
        $department = Department::findOrFail($user->department_id);
        $department_name = $department->name;

        $staffCount = User::where('department_id', $department->id)
            ->count();
        $staffCount = $staffCount - 1;

        $totalPosts = Idea::where('department_id', $department->id)->count();

        if ($eventId != "" || !empty($eventId)) {

            $eventId = $request->input('event');
            $event = Event::find($eventId);
            $eventName = $event ? $event->name : '';

            $anonymousPosts = Idea::where('department_id', $department->id)
                ->where('is_anonymous', 'Yes')
                ->where('event_id', $eventId)
                ->count();

            $percentageAnonymous = ($totalPosts > 0) ? ($anonymousPosts / $totalPosts) * 100 : 0;
            $percentageAnonymous = round($percentageAnonymous, 0);
            $percentageNotAnonymous = 100 - $percentageAnonymous;

            $commentingUsersCount = User::where('department_id', $department->id)
                ->whereHas('comments', function ($query) use ($department, $eventId) {
                    $query->whereHas('idea', function ($query) use ($department, $eventId) {
                        $query->where('department_id', $department->id)
                            ->where('event_id', $eventId);
                    });
                })
                ->count();


            $percentageCommentingUsers = ($staffCount > 0) ? ($commentingUsersCount / $staffCount) * 100 : 0;
            $percentageCommentingUsers = round($percentageCommentingUsers, 0);
            $percentageNotCommentingUsers = 100 - $percentageCommentingUsers;

            $staffWithPostsCount = User::where('department_id', $department->id)
                ->whereHas('ideas', function ($query) use ($department, $eventId) {
                    $query->where('department_id', $department->id)
                        ->where('event_id', $eventId);
                })
                ->count();

            $staffNotPostingIdeas = User::where('department_id', $department->id)
                ->whereDoesntHave('ideas', function ($query) use ($department, $eventId) {
                    $query->where('department_id', $department->id)
                        ->where('event_id', $eventId);
                })
                ->count();


            return view('reportForQACoordinator.index', compact('staffCount', 'department_name', 'percentageAnonymous','percentageNotAnonymous', 'percentageCommentingUsers', 'percentageNotCommentingUsers', 'staffWithPostsCount', 'staffNotPostingIdeas', 'eventName'));
        } else {

            $anonymousPosts = Idea::where('department_id', $department->id)
                ->where('is_anonymous', 'Yes')
                ->count();


            $percentageAnonymous = ($totalPosts > 0) ? ($anonymousPosts / $totalPosts) * 100 : 0;
            $percentageAnonymous = round($percentageAnonymous, 0);
            $percentageNotAnonymous = 100 - $percentageAnonymous;

            $commentingUsersCount = User::where('department_id', $department->id)
                ->whereHas('comments', function ($query) use ($department) {
                    $query->whereHas('idea', function ($query) use ($department) {
                        $query->where('department_id', $department->id);
                    });
                })
                ->count();
            $percentageCommentingUsers = ($staffCount > 0) ? ($commentingUsersCount / $staffCount) * 100 : 0;
            $percentageCommentingUsers = round($percentageCommentingUsers, 0);
            $percentageNotCommentingUsers = 100 - $percentageCommentingUsers;

            $staffWithPostsCount = User::where('department_id', $department->id)
                ->whereHas('ideas', function ($query) use ($department) {
                    $query->where('department_id', $department->id);
                })
                ->count();


            $staffNotPostingIdeas = User::where('department_id', $department->id)
                ->whereDoesntHave('ideas', function ($query) use ($department) {
                    $query->where('department_id', $department->id);
                })
                ->count();

            $eventName = '';



            return view('reportForQACoordinator.index', compact('staffCount', 'department_name', 'percentageAnonymous', 'percentageNotAnonymous','percentageCommentingUsers', 'percentageNotCommentingUsers', 'staffWithPostsCount', 'staffNotPostingIdeas', 'eventName'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
