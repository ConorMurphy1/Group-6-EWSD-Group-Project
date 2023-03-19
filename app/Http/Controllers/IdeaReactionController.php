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

        if($idea->reactions()->where('user_id', auth()->id())->where('reaction', 'like')->exists())
        {
            $likeIcon = view('components.icons.like-solid')->render();
            $unlikeIcon = view('components.icons.unlike-outline')->render();
        }
        else 
        {
            $likeIcon = view('components.icons.like-outline')->render();
            $unlikeIcon = view('components.icons.unlike-outline')->render();
        }

        return response()->json(['likes' => $likes, 
            'unlikes' => $unlikes, 
            'likeIcon' => $likeIcon, 
            'unlikeIcon' => $unlikeIcon
        ]);
    }
    
    public function unlike(Request $request, Idea $idea)
    {
        $this->traitUnlike($request);

        $likes = $idea->reactions()->where('reaction', '=', 'like')->count();
        $unlikes = $idea->reactions()->where('reaction', '=', 'unlike')->count();

        if($idea->reactions()->where('user_id', auth()->id())->where('reaction', 'unlike')->exists())
        {
            $unlikeIcon = view('components.icons.unlike-solid')->render();
            $likeIcon = view('components.icons.like-outline')->render();
        }
        else 
        {
            $unlikeIcon = view('components.icons.unlike-outline')->render();
            $likeIcon = view('components.icons.like-outline')->render();
        }

        return response()->json([
            'likes' => $likes, 
            'unlikes' => $unlikes, 
            'unlikeIcon' => $unlikeIcon, 
            'likeIcon' => $likeIcon]
        );
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
