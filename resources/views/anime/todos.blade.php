<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todos os Animes</title>
  <link rel="stylesheet" href="{{ asset('css/stylo.css') }}">
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
    <img id="sapo" src="{{ asset('images/logoSapo.png') }}" alt="Logo" >
  </div>

<!-- Layout Principal -->
<div id="tudo">
  <div id="conteutoglobal">
    <!-- Título -->
    <div id="header-animes">
      <div class="titulo">Todos os Animes</div>
      <div id="destaques-container">Animes Recentes</div>
    </div>

    <!-- Conteúdo Principal -->
    <div id="conteudoTotal">
      <div id="conteudo">
      <a href="{{ route('anime.create') }}" class="btn-primary">Adicionar Novo Anime</a>
        @auth
          @forelse($animes as $anime)
            <div class="postagem">
              <h2>{{ $anime->titulo }}</h2>
              <a href="{{ route('anime.show', $anime->id) }}">
                <img 
                  src="{{ asset(str_replace('public/', 'storage/', $anime->imagem_url)) }}" 
                  class="card-img-top" 
                  alt="{{ $anime->titulo }}">
              </a>
              <a href="{{ route('anime.avaliar', $anime->id) }}" class="btn-primary">Avaliar</a>
            </div>
          @empty
            <p>Não há animes disponíveis para avaliação.</p>
          @endforelse
        @endauth

        @guest
          <p>Para ver os animes, você precisa estar logado.</p>
        @endguest
      </div>

      <!-- Barra Lateral -->
      <div id="login">
        <div id="conteudo-destaque">
          @forelse($recentAnimes as $anime)
            <div class="postagem">
              <h2>{{ $anime->titulo }}</h2>
              <a href="{{ route('anime.show', $anime->id) }}">
              <img 
                src="{{ asset(str_replace('public/', 'storage/', $anime->imagem_url)) }}" 
                class="card-img-top" 
                alt="{{ $anime->titulo }}">
              </a>
            </div>
          @empty
            <p>Nenhum anime encontrado.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/iniciar.js') }}"></script>
</body>
</html>
