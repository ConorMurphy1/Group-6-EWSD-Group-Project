<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\UploadTrait;
use App\Models\Event;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CSV_Export;
use ZipArchive;

class IdeaController extends Controller
{
    public function exportToCSV(Request $request)
    {
        $event_id = $request->input('event');
        if($event_id = null || $event_id == '')
        {
            return redirect()->back()->with('error', 'Please select event to make export!');
        }
        else
        {
            $fileName = 'idea-csv.csv';
    
            // Export and store the CSV file
            Excel::store(new CSV_Export($event_id), $fileName);
        
            // Flash a success message to the session
            session()->flash('success', 'CSV exported successfully');
        
            // Download the CSV file and delete it after sending
            $path = storage_path('app/'.$fileName);
            $response = response()->download($path)->deleteFileAfterSend(true);
            $response->headers->set('Content-Type', 'text/csv');
            
            return $response;
        }
 
    }
    


    public function downloadDocument(Request $request)
    {
        $event_id = $request->input('event');
        $ideas = Idea::where('event_id', $event_id)->whereNotNull('document')->get();

        if ($ideas->isEmpty()) {
            // Return an error message if there are no ideas with a document attachment
            return redirect()->back()->with('error', 'No ideas with document attachments found for selected event.');
        }

        $zip = new ZipArchive;
        $fileName = 'event-' . $event_id . '-documents.zip';

        if ($zip->open($fileName, ZipArchive::CREATE) !== TRUE) {
            return redirect()->back()->with('error', 'Failed to create zip file');
        }

        foreach ($ideas as $idea) {
            $filePath = storage_path('app/public/' . $idea->document);

            if (file_exists($filePath)) {
                $zip->addFile($filePath, $idea->document);
            }
        }

        $zip->close();

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }




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
