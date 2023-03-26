<?php

namespace App\Http\Controllers;

use App\Models\{Category, Idea, Department, Event};
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $events = Event::whereDate('end_date', '>', now()->format('Y-m-d'))->get();
        $categories = Category::all();
        // $ideas = Idea::paginate(5);
        $ideas = Idea::with('comments')->latest()->get();

        return view('newsfeed.index', compact('ideas', 'departments', 'events', 'categories'));
    }
}
