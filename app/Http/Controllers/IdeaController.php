<?php

namespace App\Http\Controllers;

use App\Events\IdeaUploaded;
use App\Models\{Idea, Event, Category, Department, IdeaCategory, IdeaReport};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\UploadTrait;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CSV_Export;
use ZipArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IdeaController extends Controller
{
    public function exportToCSV(Request $request)
    {
        $event_id = $request->input('event');
        if ($event_id = null || $event_id == '') {
            return redirect()->back()->with('error', 'Please select event to make export!');
        } else {
            $fileName = 'idea-csv.csv';

            // Export and store the CSV file
            Excel::store(new CSV_Export($event_id), $fileName);

            // Flash a success message to the session
            session()->flash('success', 'CSV exported successfully');

            // Download the CSV file and delete it after sending
            $path = storage_path('app/' . $fileName);
            $response = response()->download($path)->deleteFileAfterSend(true);
            $response->headers->set('Content-Type', 'text/csv');

            return $response;
        }
    }



    public function downloadDocument(Request $request)
    {
        $event_id = $request->input('event');
        $ideas = DB::table('ideas')
                ->where('event_id', $event_id)
                ->whereNotNull('document')
                ->get();

        $event = DB::table('ideas')
                ->join('events', 'ideas.event_id', '=', 'events.id')
                ->select('events.name')
                ->where('event_id', $event_id)
                ->first();
        $event_name = $event->name;


        if ($ideas->isEmpty()) {
            // Return an error message if there are no ideas with a document attachment
            return redirect()->back()->with('error', 'No ideas with document attachments found for selected event.');
        }

        $zip = new ZipArchive;
        $fileName = 'event-' . $event_name . 'Event-documents.zip';
        $filePath = public_path($fileName);

        if ($zip->open($filePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return redirect()->back()->with('error', 'Failed to create zip file');
        }

        foreach ($ideas as $idea) {
            $file = public_path('storage/documents/' . $idea->document);

            if (file_exists($file)) {
                $zip->addFile($file, $idea->document);
            }
        }

        $zip->close();
        Alert::toast('Download Success!', 'success');
        return response()->download($filePath)->deleteFileAfterSend(true);

    }




    use UploadTrait;

    public function index()
    {
        $ideas = Idea::paginate(5);
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            return view('ideas.index', compact('ideas'));
        }
        else{
            Alert::alert('You do not have permission to view this website!!!');
            return redirect()->route('ideas.feed');
        }
    }

    public function create()
    {
        $idea = new Idea();
        $categories = Category::all();
        $events = Event::whereDate('closure', '>', now())->get();
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            return view('ideas.create-edit', compact('idea', 'events', 'categories'));
        }
        else{
            Alert::alert('You do not have permission to view this website!!!');
            return redirect()->route('ideas.feed');
        }
    }

    public function userCreate()
    {
        $idea = new Idea();
        $categories = Category::all();
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now())->get();

        return view('ideas.user-create-edit', compact('idea', 'events', 'categories', 'departments'));
    }

    public function userStore(Request $request)
    {
        $ideaData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'event_id' => ['required', 'integer'],
            'is_anonymous' => ['required'],
            'department_id' => ['required', 'integer'],
            // 'category_ids' => ['required', 'array'],
            // 'category_ids.*' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp', 'max:2048'],
        ]);

        $ideaData['user_id'] = auth()->id();

        if($request->image)
        {
            // $imageName = $this->updateImage('image', 'images', auth()->user()->image);
            $imageName = $this->uploadImage('image', 'images');
            $ideaData['image'] = $imageName;
        }

        if($request->hasFile('document'))
        {
            $documentName = $this->uploadDoc('document', 'documents');
            $ideaData['document'] = $documentName;
        }

        $idea = Idea::create($ideaData);

        /** dispatch the event -> then send email to department coordinator */
        event(new IdeaUploaded($idea));
        // Log::info('Event dispatched');

        Alert::toast('Idea created successfully', 'success');
        return redirect()->route('ideas.feed');
    }

    public function userEdit($id)
    {
        $idea = Idea::findOrFail($id);
        $categories = Category::all();
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now())->get();

        return view('ideas.user-create-edit', compact('idea', 'events', 'categories', 'departments'));
    }

    public function userUpdate(Request $request, Idea $idea)
    {
        $ideaData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'event_id' => ['required', 'integer'],
            'is_anonymous' => ['required'],
            'department_id' => ['required', 'integer'],
            // 'category_ids' => ['required', 'array'],
            // 'category_ids.*' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp', 'max:2048'],
        ]);

        if($request->image)
        {
            // $imageName = $this->updateImage('image', 'images', auth()->user()->image);
            $imageName = $this->uploadImage('image', 'images');
            $ideaData['image'] = $imageName;
        }

        if($request->hasFile('document'))
        {
            $documentName = $this->uploadDoc('document', 'documents');
            $ideaData['document'] = $documentName;
        }

        $idea->update($ideaData);

        // $categories = request()->input('category_ids');
        // if(!empty($categories))
        // {
        //     $idea->categories->attach($categories);
        // }

        Alert::toast('Idea updated', 'success');
        return back();
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->category_ids){
        $data = $request->validate([
            'title' => 'required | string',
            'description' => 'required | string',
            'event_id' => 'required | integer',
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp', 'max:2048'],
        ]);

        if($request->image)
        {
            $imageName = $this->uploadImage('image', 'images');
            $data['image'] = $imageName;
        }

        if($request->hasFile('document'))
        {
            $documentName = $this->uploadDoc('document', 'documents');
            $data['document'] = $documentName;
        }

        $is_anonymous_final = $request->is_anonymous === "yes" ? true : false;

        $data['user_id'] = auth()->id();
        $data['is_anonymous'] = $is_anonymous_final;
        $data['department_id'] = auth()->user()->department_id;

        $idea = Idea::create($data);


            for($i = 0; $i < count($request->category_ids); ++$i)
            {
                IdeaCategory::create([
                    'idea_id' => $idea->id,
                    'category_id' => $request->category_ids[$i],
                ]);
            }
            if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
                Alert::toast('Idea created successfully', 'success');
                return redirect()->route('ideas.index');
            }
            else{
                Alert::toast('Idea created successfully', 'success');
                return redirect()->route('ideas.feed');
            }
        }else{
            Alert::toast('Category missing', 'warning');
            return back();
        }


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
        $categories = Category::all();
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now())->get();
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            return view('ideas.create-edit', compact('idea', 'events', 'departments', 'categories'));
        }
        else{
            Alert::alert('You do not have permission to view this website!!!');
            return redirect()->route('ideas.feed');
        }
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
        $idea = Idea::find($id);
        $data = $request->validate([
            'title' => 'required | string ',
            'description' => 'required | string',
            'event_id' => 'required | integer'
        ]);

        $idea->update($data);

        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 3){
            Alert::toast('Idea update successfully', 'success');
            return redirect()->route('ideas.index');
        }
        else{
            Alert::toast('Idea update successfully', 'success');
            return redirect()->route('ideas.feed');
        }
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
        Alert::toast('Congrats!, You have successfully deleted an Idea', 'success');
        return back();
    }

    /** For user panel */
    public function userDelete(Idea $idea)
    {
        $idea->delete();

        Alert::toast('Congrats!, You have successfully deleted an Idea', 'success');
        return redirect()->route('ideas.feed');
    }

    /** report submitted by QA Coord */
    public function report(Request $request, Idea $idea)
    {
        if (!$request->filled('description')) {
            Alert::toast('Description must be defined', 'warning');
            return back();
        }

        $reporter = $request->input('reporter_id');

        /** can't report twice for a specific idea */
        if(IdeaReport::where('user_id', $reporter)->where('idea_id', $idea->id)->exists())
        {
            Alert::toast('Cannot report the same idea twice', 'error');
            return back();
        }

        $report = new IdeaReport();
        $report->idea_id = $idea->id;
        $report->user_id = $reporter;
        $report->description = $request->input('description');
        $report->save();

        Alert::toast('You have reported the idea to admin', 'success');
        return back();
    }
}
