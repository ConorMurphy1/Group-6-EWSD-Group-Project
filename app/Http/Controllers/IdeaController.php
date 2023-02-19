<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Idea::paginate(5);

        return view('ideas.index', compact('ideas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idea = new Idea();
        return view('ideas.create-edit', compact('idea'));
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
            'title' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg',
            'description' => 'required|string',
            'is_anonymous' => 'required|boolean',
            'document_path' => 'nullable|string',
            'closure_date' => 'required|date'
        ]);
        // dd($data);

        $imageName = $this->uploadImage('image','images');

        $data['image'] = $imageName;
        $data['user_id'] = auth()->user()->id;
        $data['department_id'] = auth()->user()->department_id;
        Idea::create($data);
        return redirect('ideas')->with('success', 'Idea created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idea = Idea::findOrFail($id);
        return view('idea.create-edit', compact('idea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
