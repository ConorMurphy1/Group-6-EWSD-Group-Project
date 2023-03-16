<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\UploadTrait;
use App\Models\Event;
use RealRashid\SweetAlert\Facades\Alert;

class IdeaController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->user()->role->role);
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
        $events = Event::whereDate('end_date', '>', now()->format('Y-m-d'))->get();

        return view('ideas.create-edit', compact('idea', 'events'));
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'description' => 'required|string',
            'is_anonymous' => 'nullable|string',
            'event_id' => 'required|integer',
            'document' => 'nullable|mimes:pdf,xls,doc',
            'closure_date' => 'required|date'
        ]);
        if($request->image){
            $imageName = $this->uploadImage('image','images');
            $data['image'] = $imageName;
        }
        if ($request->hasFile('document')) {
            $documentName = $this->uploadDoc('document', 'documents');
            $data['document'] = $documentName;
        }

        $is_anonymous_final = $request->is_anonymous === "yes" ? 'Yes' : 'No';


        $data['user_id'] = auth()->user()->id;
        $data['is_anonymous'] = $is_anonymous_final;
        $data['department_id'] = auth()->user()->department_id;

        // dd($data);

        Idea::create($data);

        Alert::toast('Idea created successfully', 'success');

        return redirect('admin\ideas')->with('success', 'Idea created successfully!');
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
        $events = Event::all();

        return view('ideas.create-edit', compact('idea', 'events'));
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
        $idea = Idea::findOrFail($id);
        $idea->delete();
        Alert::toast('Congrats!', 'You have successfully deleted a Idea', 'success');
        return back();
    }
}
