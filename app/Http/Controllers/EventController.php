<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;
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

        $validated['user_id'] = auth()->user()->id;
        $created = Event::create($validated);
        return redirect('/')->with('msg','Evento criado com sucesso!');
    }

    public function show($id){
        $event = Event::findOrFail($id);
        $eventOwner = User::where('id',$event->user_id)->first()->toArray();
        return view('events.show',['event' => $event, 'eventOwner'=> $eventOwner]);
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;
        return view('events.dashboard',['events'=> $events]);
    }
    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect(route('events.dashboard'))
        ->with('msg','Evento excluido com sucesso!');
    }

    public function edit($id){
        $event = Event::findOrFail($id);
        return view('events.edit', ['event'=> $event]);
    }

    public function update(Request $request){
        $data = $request->all();
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->image;
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName() . strtotime('now') ). ".$extension";
            $image->move(public_path('img/events'),$imageName);
            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        
        return redirect('/dashboard')->with('msg','Evento editado com sucesso!');
    }

}
