<?php

namespace App\Http\Controllers;

use App\Http\Traits\HandleReactions;
use Illuminate\Http\Request;

class IdeaReactionController extends Controller
{
    use HandleReactions {
        like as traitLike;
        unlike as traitUnlike;
    }

    public function like(Request $request)
    {
        $this->traitLike($request);
        return redirect()->back();
    }
    
    public function unlike(Request $request)
    {
        $this->traitUnlike($request);
        return redirect()->back();
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
