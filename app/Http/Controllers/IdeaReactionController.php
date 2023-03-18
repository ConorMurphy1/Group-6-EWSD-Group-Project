<?php

namespace App\Http\Controllers;

use App\Http\Traits\HandleReactions;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaReactionController extends Controller
{
    use HandleReactions {
        like as traitLike;
        unlike as traitUnlike;
    }

    public function like(Request $request, Idea $idea)
    {
        $this->traitLike($request);

        $likes = $idea->reactions()->where('reaction', '=', 'like')->count();
        $unlikes = $idea->reactions()->where('reaction', '=', 'unlike')->count();

        return response()->json(['likes' => $likes, 'unlikes' => $unlikes]);
    }
    
    public function unlike(Request $request, Idea $idea)
    {
        $this->traitUnlike($request);

        $likes = $idea->reactions()->where('reaction', '=', 'like')->count();
        $unlikes = $idea->reactions()->where('reaction', '=', 'unlike')->count();

        return response()->json(['likes' => $likes, 'unlikes' => $unlikes]);
    }

    public function table()
    {
        return 'idea_reactions';
    }

    public function reactionable_id_name()
    {
        return 'idea_id';
    }
}
