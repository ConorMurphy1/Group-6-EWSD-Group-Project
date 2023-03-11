<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Trait\UploadTrait;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::paginate(5);

        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comment = new comment();
        return view('comments.create-edit', compact('comment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'is_anonymous' => 'nullable|string',
            'comment' => 'required|string',
        ]);

        $is_anonymous_final = $request->is_anonymous === "yes" ? 'Yes' : 'No';

        // $data['user_id'] = auth()->user()->id;
        $data['is_anonymous'] = $is_anonymous_final;

        Comment::create($data);

        Alert::toast('comment success!', 'success');

        return redirect('comments')->with('success', 'comment success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.create-edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'is_anonymous' => 'nullable|string',
            'comment' => 'required|string',
        ]);

        $is_anonymous_final = $request->is_anonymous === "yes" ? 'Yes' : 'No';

        // $data['user_id'] = auth()->user()->id;
        $data['is_anonymous'] = $is_anonymous_final;

        Comment::find($id)->update($data);

        Alert::toast('Comment edited successfully', 'success');

        return redirect('comments')->with('success','Comment edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Alert::toast('Congrats!', 'You have successfully deleted your Comment', 'success');
        return back();
    }
}
