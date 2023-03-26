<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(5);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();

        return view('events.create-edit', compact('event'));
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
            'name' => 'required|unique:events',
            'description' => 'nullable|string',
            'closure' => 'required|date',
            'final_closure' => 'required|date'
        ]);
        Event::create($data);

        Alert::toast('Event created successfully', 'success');

        return redirect()->route('events.index')->with('success', 'Event created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.create-edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        $data = $request ->validate([
            'name' => 'required|min:2|max:20',
            'description' => 'nullable|string',
            'closure' => 'required|date',
            'final_closure' => 'required|date'
        ]);

        $event->update($data);

        // Alert::toast('Event updated successfully', 'success');

        return redirect('admin/events')->with('success', 'Event Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        Alert::toast('Congrats!', 'You have successfully deleted a Event', 'success');
        return back();
    }
}