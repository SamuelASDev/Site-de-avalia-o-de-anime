<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $anime->titulo }}</title>
  <link rel="stylesheet" href="{{ asset('css/stylo.css') }}">

  <style>
        #avaliacoes {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .avaliacoes-titulo {
        text-align: center;
        font-size: 1.8em;
        margin-bottom: 20px;
    }

    .alert {
        background-color: #f9f9f9;
        border-left: 5px solid #007bff;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .alert h5 {
        margin-bottom: 10px;
        font-weight: bold;
    }

    .alert p {
        margin: 5px 0;
    }

    .titulo {
    width: 100%;
    text-align: left;
    font-size: 1.5em;
    font-weight: bold;
    color: white;
    padding-top: 1rem;
    padding-bottom: 1rem;
    padding-left: 1rem;
    margin: 0;
    background: linear-gradient(90deg, #1E73BE, #54B952);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  </style>
</head>
<body>

<!-- Navbar -->
<nav id="navbar">
  <button class="menu-toggle" id="menuToggle">☰</button>
  <div id="navbar-container">
    <a href="#">Perfil</a>
    <a href="{{ route('home') }}">Página Inicial</a>
    <a href="{{ route('anime.todos') }}">Todos os Animes</a>
    <form action="/search" method="GET">
      <input type="search" name="query" placeholder="Pesquisar anime..." aria-label="Pesquisar">
      <button type="submit">
        <img id="lupa" src="{{ asset('images/lupa.png') }}" alt="lupa">
      </button>
    </form>
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

<!-- Conteúdo Principal -->
<div id="tudo">
  <div id="conteutoglobal">

    <!-- Título do Anime -->
    <div id="header-animes">
      <div class="titulo">{{ $anime->titulo }}</div>
    </div>

    <!-- Informações do Anime -->
    <div class="postagem">
      <img 
        src="{{ asset(str_replace('public/', 'storage/', $anime->imagem_url)) }}" 
        class="card-img-top" 
        alt="{{ $anime->titulo }}"
        style="max-width: 100%; max-height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
      <h2>{{ $anime->titulo }}</h2>
      <p><strong>Resumo:</strong> {{ $anime->resumo }}</p>
      <p><strong>Data de Lançamento:</strong> {{ $anime->data_lancamento }}</p>
      <p><strong>Média Geral:</strong> {{ $mediaNotas ?? 'Sem avaliações ainda' }}</p>
      <p></p><a href="{{ route('anime.avaliar', $anime->id) }}" class="btn-primary">Avaliar</a></p>
    </div>

    <!-- Lista de Avaliações -->
    <div id="avaliacoes">
      <h3 class="avaliacoes-titulo">Avaliações</h3>
      @if($avaliacoes->isEmpty())
        <p>Nenhuma avaliação encontrada para este anime.</p>
      @else
        @foreach($avaliacoes as $avaliacao)
          <div class="alert">
          <p><strong>Usuário:</strong> {{ $avaliacao->name }}</p>
          <p><strong>Nota:</strong> {{ $avaliacao->pivot->NotaAnime }}</p>
          <p><strong>Opinião:</strong> {{ $avaliacao->pivot->Opinião }}</p>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>

<script src="{{ asset('js/iniciar.js') }}"></script>
</body>
</html>
