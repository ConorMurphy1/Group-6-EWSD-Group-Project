<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailNotification;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;
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
        
        /** 
         * <script> tag will not be executed
         */
        $newComment = view('comments.comment', compact('comment', 'idea'))->render();
        return response()->json($newComment);
    }

    public function edit(Request $request, Idea $idea, Comment $comment)
    {

    }

    public function update(Request $request, Idea $idea, Comment $comment)
    {
        $editedComment = $request->json('comment');
        $comment->update([
            'comment' => $editedComment,
            'is_edited' => true,
        ]);

        return response()->json(['message' => 'Comment changed successfully', 'comment' => $editedComment]);
    }

    public function destroy(Idea $idea, Comment $comment)
    {
        $comment->delete();
        Alert::toast('Congrats!, You have successfully deleted your Comment', 'success');
        return back();
    }
}
