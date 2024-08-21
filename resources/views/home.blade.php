@extends('layouts.main')
@section('title', 'HDC Events')
 

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento:</h1>
    <form action="/" method="GET">
        <input type="text" class="form-control" name="search" id="search" placeholder="Procure um evento">
    </form>
</div>
<div id="events-container" class="col-md-12">

    @if (count($events) == 0)
        <h2 class="text-muted mt-sm-5 text-center">Não há eventos disponíveis</h2>
    @else
        @if (isset($search))
            <h2 class="text-center">Buscando por : "{{ $search }}"</h2>
        @else
            <h2 class="text-center">Proximos eventos</h2>
            <p class="text-center">Veja os eventos dos proximos dias</p>
        @endif

        <div id="cards-container" class="row">
        @foreach ($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{$event->image }}" alt="{{ $event->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-participants">X Participantes</p>
                    <a href="{{ route('events.show',"$event->id") }}" class="btn btn-warning">Saber mais</a>
                </div>
            </div>
        @endforeach
        </div>
    
    @endif

</div>
@endsection