@extends('layouts.main')
@section('title','Criar evento')
@section('content')
<div id="events-create-container" class="col-md-6 offset-md-3">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div> 
    @endif
    <h1>Crie um evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image" class="form-label">Imagem do evento:</label>
            <input
                type="file"
                name="image"
                id="image"
                class="form-control"
            />
        </div>
        
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="">Cidade:</label>
            <input type="text" name="city" id="city" class="form-control" placeholder="Local do evento">
        </div>
        <div class="form-group">
            <label for="private">O evento e privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="1">Sim</option>
                <option value="0">Nao</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descricao</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
        </div>
        <div class="form-group">
            <label for="title">Adicione items de infraestrutura</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras">Cadeiras               
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco">Palco               
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja gratis">Cerveja gratis               
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open food">Open food               
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes">Brindes               
            </div>
        </div>
        <button type="submit" class="btn btn-warning">Criar evento</button>
    </form>
</div>
@endsection