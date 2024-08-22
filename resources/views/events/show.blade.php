@extends('layouts.main')
@section('title', $event->title)

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/events/{{ $event->image }}" class="image-fluid" alt="{{ $event->title }}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="event-city">{{ $event->city }}</p>
            <p class="events-participants">{{count($event->users)  }} Participantes</p>
            <p class="event-owner">Criado por <b> {{ $eventOwner['name'] }}</b></p>

            @if ($isParticipating)
            <form action="/events/leave/{{ $event->id }}" method="post">
                @csrf
                @method('delete')
                    <button
                    type="disabled" 
                    class="btn btn-success" 
                    id="event-submit"
                    onclick="
                    event.preventDefault();
                    this.closest('form').submit()"
                    >Sair do evento</button>
                @else
                <form action="/events/join/{{ $event->id }}" method="post">
                    @csrf
                     <button
                     type="submit" 
                     class="btn btn-warning" 
                     id="event-submit"
                     onclick="
                     event.preventDefault();
                     this.closest('form').submit();"
                     >Confirmar presenca</button>
                @endif

            </form>
            <h3>O evento conta com:</h3>
            <ul id="items-list">
                @foreach ($event->items as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-12" id="description-container">
            <h3>Sobre o evento</h3>
            <p class="event-description">{{ $event->description }}</p>
        </div>
    </div>
</div>
@endsection