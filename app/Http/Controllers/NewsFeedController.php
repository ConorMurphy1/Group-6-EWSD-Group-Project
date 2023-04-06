<?php

namespace App\Http\Controllers;

use App\Models\{Category, Idea, Department, Event, IdeaCategory, IdeaReaction};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsFeedController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now()->format('Y-m-d'))->get();
        $categories = Category::all();

        $ideas = Idea::with('comments', 'user', 'event')->latest()->paginate(5);

        $ideaCategories = IdeaCategory::all();

        // dd($ideas);

        return view('newsfeed.index', compact('ideas', 'departments', 'events', 'ideaCategories', 'categories'));
    }

    public function search(Request $request)
    {
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now()->format('Y-m-d'))->get();
        $categories = Category::all();
        $ideaCategories = IdeaCategory::all();

        $mostLiked = IdeaReaction::where('reaction', 'like')->groupBy('reaction', 'idea_id')->select('reaction', 'idea_id', IdeaReaction::raw('count(*) as liked'))->pluck('idea_id');

        // dd($mostLiked);

        $ideas = Idea::with('comments', 'user', 'event', 'reactions')->where(function ($query) use ($request, $mostLiked){
                            if($request->category_id)
                            {
                                $query->whereHas(function ($categories) use ($request)
                                {
                                    $categories->where('category_id', $request->category_id);
                                });
                            }
                            if($request->event_id)
                            {
                                $query->where('event_id', $request->event_id);
                            }

                            if($request->department_id)
                            {
                                $query->where('department_id', $request->department_id);
                            }

                            if($request->popularity)
                            {
                                if($request->popularity == 'most')
                                {
                                    $query->select('ideas.*', DB::raw('COUNT(idea_reactions.id) as total_likes'))
                                            ->leftJoin('idea_reactions', function($join) {
                                                $join->on('idea_reactions.idea_id', '=', 'ideas.id')
                                                    ->where('idea_reactions.reaction', '=', 'like');
                                            })
                                            ->groupBy('ideas.id')
                                            ->orderBy('total_likes', 'desc');
                                }
                                if($request->popularity == 'less')
                                {
                                    $query->select('ideas.*', DB::raw('COUNT(idea_reactions.id) as total_dislikes'))
                                            ->leftJoin('idea_reactions', function($join) {
                                                $join->on('idea_reactions.idea_id', '=', 'ideas.id')
                                                    ->where('idea_reactions.reaction', '=', 'dislike');
                                            })
                                            ->groupBy('ideas.id')
                                            ->orderBy('total_dislikes', 'desc');
                                }
                            }
                        })
                        ->latest()->paginate(5);



        return view('newsfeed.index', compact('ideas', 'departments', 'events', 'ideaCategories', 'categories'));
    }

    public function events()
    {
        $events = Event::where('final_closure', '>=', now())->get();
        return view('newsfeed.events', compact('events'));
    }

}
