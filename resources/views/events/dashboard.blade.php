@extends('layouts.main')

@section('title' , 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container my-sm-5">
    <h1>Meus eventos</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Acoes</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td scopt='row'>{{ $loop->index + 1 }}</td>
                    <td> <a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ count($event->users)}}</td>
                    <td><a href="/events/edit/{{ $event->id }}" class="btn btn-dark edit-btn">Editar</a></td>
                    <td>
                        <form action="/events/{{ $event->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button 
                         type="submit"
                         class="btn btn-danger">Deletar</button>
                        </form>                    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Voce nao tem eventos ainda, <a href="{{ route('events.create') }}">Criar evento</a></p> 
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container my-sm-5">
    <h3>Eventos que estou participando</h3>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    
    @if (count($eventsAsParticipant) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Acoes</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($eventsAsParticipant as $event)
                <tr>
                    <td scopt='row'>{{ $loop->index + 1 }}</td>
                    <td> <a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ count($event->users) }}</td>
                    <td>
                        <form action="/events/leave/{{$event->id}}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-dark edit-btn">Sair do evento</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    {{-- {{ dd($eventsAsParticipant)}} --}}
    <p>Voce nao esta participando de nenhum evento, <a href="{{ route('events.index') }}">veja todos os eventos</a></p> 
    @endif
</div>

@endsection