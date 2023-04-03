<?php

namespace App\Http\Controllers;

use App\Models\{Category, Idea, Department, Event, IdeaCategory};
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now()->format('Y-m-d'))->get();
        $categories = Category::all();

        $ideas = Idea::with('comments', 'user', 'event')->latest()->paginate(5);

        $ideaCategories = IdeaCategory::all();

        // $ideas = Idea::with('comments', 'user')->latest()->paginate(5);

        return view('newsfeed.index', compact('ideas', 'departments', 'events', 'ideaCategories', 'categories'));
    }

    public function search(Request $request)
    {
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now()->format('Y-m-d'))->get();
        $categories = Category::all();
        $ideaCategories = IdeaCategory::all();

        $ideas = Idea::with('comments', 'user', 'event')->where(function ($query) use ($request){
                            if($request->category_id)
                            {
                                $query->whereHas(function ($categories) use ($request)
                                {
                                    $categories->where('$category_id', $request->category_id);
                                });
                            }
                        })
                        ->latest()->paginate(5);
        
        

        return view('newsfeed.index', compact('ideas', 'departments', 'events', 'ideaCategories', 'categories'));
    }
}
