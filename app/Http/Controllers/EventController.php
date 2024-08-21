<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller{
    public function index(){
        $search = request('search');
        isset($search) ? $events = Event::where('title','like',"%$search%")->get() :
        $events = Event::all();

        return view('home', ['events'=> $events , 'search'=> $search]);        
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $validated  = $request->validate([
            "title" => 'required',
            "city" => 'required',
            "private" => 'required',
            "description" => 'required',
            "image" => 'required|file',
            "items"=> 'required',
            "date" => 'required'
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->image;
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName() . strtotime('now') ). ".$extension";
            $image->move(public_path('img/events'),$imageName);
            $validated['image'] = $imageName;
        }

        $created = Event::create($validated);
        return redirect('/')->with('msg','Evento criado com sucesso!');
    }

    public function show($id){
        $event = Event::findOrFail($id);
        return view('events.show',['event' => $event]);
    }
}
