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
    public function show(Event $event)
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
        $event = Event::findOrFail($id);
        return view('events.create-edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:events,name,'.$event->id,
            'description' => 'nullable|string',
            'closure' => 'required|date',
            'final_closure' => 'required|date'
        ]);
    
        $event->update($validatedData);
    
        Alert::toast('Event updated successfully', 'success');
    
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $eventData = Event::findOrFail($id);
        $eventData->delete();
        Alert::toast('Congrats!', 'You have successfully deleted an event', 'success');
        return back();
    
    }
}
