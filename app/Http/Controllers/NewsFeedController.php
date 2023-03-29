<?php

namespace App\Http\Controllers;

use App\Models\{Category, Idea, Department, Event};
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now()->format('Y-m-d'))->get();
        $categories = Category::all();

        $ideas = Idea::with('comments', 'user', 'event')->latest()->get();
        // $ideas = Idea::with('comments', 'user')->latest()->paginate(5);

        return view('newsfeed.index', compact('ideas', 'departments', 'events', 'categories'));
    }
}
