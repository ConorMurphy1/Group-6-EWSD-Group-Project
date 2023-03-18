<?php

namespace App\Http\Controllers;

use App\Mail\CommentNotification;
use App\Mail\NewCommentNotification;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;
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
            'is_anonymous' => 'nullable|string',
            'comment' => 'required|string',
        ]);

        $is_anonymous_final = $request->is_anonymous === "yes" ? true : false;

        $data['is_anonymous'] = $is_anonymous_final;
        $data['user_id'] = auth()->id();
        $data['idea_id'] = $idea->id;

        $comment = Comment::create($data);
        Alert::toast('comment success!', 'success');

        $user = $idea->user;

        // TODO: implement with queues 
        Mail::send('emails.notify', [
            'comment' => $comment->comment,
            'user' => $user,
            'title' => $idea->title
        ], function($mail) use ($user) {
            $mail->from('example@laravel.ac.uk', 'Laravel');
            $mail->to($user->email, $user->name)->subject('New comment on you idea post');
        });
        
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
