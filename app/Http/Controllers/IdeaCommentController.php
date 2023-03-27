<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailNotification;
use App\Mail\CommentNotification;
use App\Mail\NewCommentNotification;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class IdeaCommentController extends Controller
{
    public function index(Request $request, Idea $idea)
    {
        $sort = $request->query('sort');

        switch ($sort) {
            case 'oldest':
                $comments = $idea->comments()->oldest()->get();
                break;
            // case 'likes':
                // $comments = $idea->comments()->oldest()->get();
                // break;
            default:
                $comments = $idea->comments()->latest()->get();
                break;
        }

        /** Load the comment view as string and sent it back as json response */
        $commentsHtml = view('newsfeed.comments', compact('comments'))->render();

        return response()->json([
            'html' => $commentsHtml,
        ]);
    }

    public function store(Request $request, Idea $idea)
    {
        $data = $request->validate([
            'comment' => 'required|string',
        ]);

        $is_anonymous_final = $request->json('is_anonymous') == 1 ? true : false;

        $data['is_anonymous'] = $is_anonymous_final;
        $data['user_id'] = auth()->id();
        $data['idea_id'] = $idea->id;

        $comment = Comment::create($data);
        $user = $idea->user;

        SendEmailNotification::dispatch($comment, $user, $idea);
        
        $newComment = view('comments.comment', compact('comment'))->render();
        return response()->json($newComment);
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
