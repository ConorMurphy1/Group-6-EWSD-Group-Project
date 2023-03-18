<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function index()
    {
        // $ideas = Idea::paginate(5);
        $ideas = Idea::latest()->get();

        return view('newsfeed.index', compact('ideas'));
    }
}
