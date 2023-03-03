<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\IdeaReaction;
use Illuminate\Http\Request;

class IdeaReactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idea = Idea::find($request->input('idea'));
        $idea->reactions()->attach(auth()->user(), ['reaction' => $request->input('reaction')]);

        return redirect()->route('newsfeed');
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdeaReaction  $ideaReaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdeaReaction $ideaReaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdeaReaction  $ideaReaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdeaReaction $ideaReaction)
    {
        //
    }
}
