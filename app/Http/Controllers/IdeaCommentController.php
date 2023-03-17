<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IdeaCommentController extends Controller
{
    public function store(Request $request, Idea $idea)
    {
        $data = $request->validate([
            'is_anonymous' => 'nullable|string',
            'comment' => 'required|string',
        ]);

        $is_anonymous_final = $request->is_anonymous === "yes" ? true : false;

        $data['is_anonymous'] = $is_anonymous_final;
        $data['user_id'] = auth()->id();
        $data['idea_id'] = $idea->id;

        Comment::create($data);

        Alert::toast('comment success!', 'success');

        return redirect()->back()->with('success', 'comment success!');
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
