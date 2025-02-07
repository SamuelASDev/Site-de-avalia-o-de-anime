<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Anime</title>
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
            <div class="titulo">Cadastrar Anime</div>

        <!-- Formulário de Cadastro -->
            <form action="{{ route('anime.store') }}" method="POST" enctype="multipart/form-data" id="form-cadastro">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="resumo" class="form-label">Resumo</label>
                    <textarea id="resumo" name="resumo" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem</label>
                    <input type="file" id="imagem" name="imagem" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="data_lancamento" class="form-label">Data de Lançamento</label>
                    <input type="date" id="data_lancamento" name="data_lancamento" class="form-control" required>
                </div>
                <button type="submit" class="btn-primary">Cadastrar</button>
            </form>
    </div>
</div>

<script src="{{ asset('js/iniciar.js') }}"></script>
</body>
</html>
