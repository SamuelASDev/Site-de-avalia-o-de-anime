<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="{{ asset('css/stylo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/criacao.css') }}">
</head>
<body>

<!-- Navbar -->
<nav id="navbar">
    <button class="menu-toggle" id="menuToggle">☰</button>
    <div id="navbar-container">
        <a href="{{ route('perfil') }}">Perfil</a>
        <a href="{{ route('home') }}">Página Inicial</a>
        <a href="{{ route('anime.todos') }}">Todos os Animes</a>

        @auth
            @if(auth()->user()->nivel === 'admin')
                <a href="{{ route('adm.dashboard') }}">Dashboard ADM</a>
            @endif
        @endauth

        <div>
            @guest
            <a href="{{ route('register') }}">Cadastro</a>
            <a href="{{ route('login') }}">Login</a>
            @endguest
            @auth
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit">Sair</button>
            </form>
            @endauth
        </div>
    </div>
</nav>

<!-- Logo -->
<div id="logo">
    <img id="sapo" src="{{ asset('images/logoSapo.png') }}" alt="Logo">
</div>

<!-- Layout Principal -->
<div id="tudo">
    <div id="conteutoglobal">
        <!-- Título -->
        <div class="titulo">Editar Usuário</div>

        <!-- Formulário de Edição -->
        <form action="{{ route('usuario.update', $usuario->id) }}" method="POST" id="form-cadastro">
            @csrf
            @method('PUT') <!-- Método PUT para indicar que é uma atualização -->

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="nivel" class="form-label">Nível</label>
                <input type="text" id="nivel" name="nivel" class="form-control" value="{{ old('nivel', $usuario->nivel) }}" required>
            </div>

            <button type="submit" class="btn-primary">Atualizar</button>
        </form>
    </div>
</div>

<script src="{{ asset('js/iniciar.js') }}"></script>
</body>
</html>
