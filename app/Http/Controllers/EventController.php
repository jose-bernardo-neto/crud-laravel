<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');
        isset($search) ? $events = Event::where('title', 'like', "%$search%")->get() :
        $events = Event::all();

        return view('home', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'city' => 'required',
            'private' => 'required',
            'description' => 'required',
            'image' => 'required|file',
            'items' => 'required',
            'date' => 'required',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->image;
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName().strtotime('now')).".$extension";
            $image->move(public_path('img/events'), $imageName);
            $validated['image'] = $imageName;
        }

        $validated['user_id'] = auth()->user()->id;
        $created = Event::create($validated);

        if (! $created) {
            return redirect('/')->with('msg', 'Ocorreu um erro ao criar evento.');
        }

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $eventParticipants = $event->users;
        $user = auth()->user();
        $isParticipating = $eventParticipants->find($user?->id);
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'isParticipating' => $isParticipating]);
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 'eventsAsParticipant' => $eventsAsParticipant]);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect(route('events.dashboard'))->with('msg', 'Evento excluido com sucesso!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        if ($event->user_id !== auth()->user()->id) {
            return redirect('/dashboard')->with('msg', 'Voce nao pode editar este evento');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->image;
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName().strtotime('now')).".$extension";
            $image->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent($id)
    {
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);

        return redirect('/dashboard')->with('msg', 'Sua presenca foi confirmada no evento ');
    }

    public function leaveEvent($id)
    {
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);

        return redirect('/dashboard')->with('msg', 'Voce saiu do evento com sucesso!');
    }
}
