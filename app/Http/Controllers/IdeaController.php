<?php

namespace App\Http\Controllers;

use App\Models\{Idea, Event, Category, Department, IdeaCategory};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\UploadTrait;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CSV_Export;
use ZipArchive;
use Illuminate\Support\Facades\DB;


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
        // dd(auth()->user()->role->role);
        $ideas = Idea::paginate(5);
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2){
            return view('ideas.index', compact('ideas'));
        }else{
            return redirect('newsfeed');
        }
    }

    public function create()
    {
        $idea = new Idea();
        $categories = Category::all();
        $events = Event::whereDate('closure', '>', now()->format('Y-m-d'))->get();

        return view('ideas.create-edit', compact('idea', 'events', 'categories'));
    }

    public function userCreate()
    {
        $idea = new Idea();
        $categories = Category::all();
        $departments = Department::all();
        $events = Event::whereDate('closure', '>', now()->format('Y-m-d'))->get();

        return view('ideas.user-create-edit', compact('idea', 'events', 'categories', 'departments'));
    }

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
        if ($request->image) {
            $imageName = $this->uploadImage('image', 'images');
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

        $idea = Idea::create($data);
        for($i=0;$i<count($request->category_ids);$i++)
        {

            IdeaCategory::create([
                'idea_id' => $idea->id,
                'category_id' => $request->category_ids[$i],
            ]);
        }
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
