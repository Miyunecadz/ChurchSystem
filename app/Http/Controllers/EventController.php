<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use LaravelFullCalendar\Facades\Calendar;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $events=Event::all();
        // $event=[];

        // foreach($events as $row) {
        //     // $enddate=$row->end_date."24:00:00";
        //     $event[]=\Calendar::event(
        //         $row->title,
        //         false,
        //         new \DateTime($row->start_date),
        //         new \DateTime($row->end_date),
        //         $row->id,
        //         [
        //             'color'=>$row->color
        //         ]
        //         );
        // }
        // $calendar=\Calendar::addEvents($event);
        // return view('calendar.eventpage', compact('events', 'calendar'));

        $events = Event::all();
        $today = now()->format('Y-m-d');
        return view('calendar.index', ['events' => $events, 'today' => $today]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function display()
    {
        return view('calendar.addevent');
    }

    public function store(Request $request)
    {
         $this->validate($request,[
             'title'=>'required',
             'color'=>'required',
             'start_date'=>'required',
             'end_date'=>'required'
         ]);

         $events=new Event;
         $events->title=$request->input('title');
         $events->color=$request->input('color');
         $events->start_date=$request->input('start_date');
         $events->end_date=$request->input('end_date');
         $events->save();

         return redirect('events')->with('success', 'Event Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $events=Event::all();
        return view('calendar.display')->with('events', $events);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $events=Event::find($id);
        return view('calendar.editform', compact('events', 'id'));
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
        $this->validate($request,[
            'title'=>'required',
            'color'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);

        $events=Event::find($id);
        $events->title=$request->input('title');
        $events->color=$request->input('color');
        $events->start_date=$request->input('start_date');
        $events->end_date=$request->input('end_date');
        $events->save();

        return redirect('events')->with('success', 'Event Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::where('id',$id)->delete();
        return redirect('displaydata');
    }
}
