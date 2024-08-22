<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="#" class="navbar-brand">
                        <img src="/img/hdcevents_logo.svg" alt="">
                    </a>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('events.index') }}" class="nav-link">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('events.create') }}" class="nav-link">Criar Eventos</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Meus eventos</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="post">
                             @csrf
                             <a 
                                href="/logout" 
                                class="nav-link"
                                onclick="
                                    event.preventDefault();
                                    this.closest('form').submit()"
                             >Sair({{ auth()->user()->name}})</a>
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest

                    </ul>
                </div>
            </nav>
        </header>
        <main class="main">
            <div class="container-fluid">
                <div class="row">
                    @if (session('msg'))
                    <div class="alert alert-info">
                        <p class="text-center">{{ session('msg') }}</p>
                    </div>
                    @endif
                    @yield('content')                   
                </div>
            </div>
        </main>
        <footer>
         <p>HDC Events &copy; 2024</p>
        </footer>

    <script src="/bootstrap/js/bootstrap.min.js" ></script>
    </body>
</html>
