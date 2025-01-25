<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avaliar: {{ $anime->titulo }}</title>
  <link rel="stylesheet" href="{{ asset('css/stylo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/avaliacao.css') }}">

  <style>
    .card-img-top {
    width: 250px; /* Largura padrão */
    height: 250px; /* Altura padrão */
   /* Mantém o aspecto das imagens */
  } 

  </style>
</head>
<body>

<!-- Navbar -->
<nav id="navbar">
  <button class="menu-toggle" id="menuToggle">☰</button>
  <div id="navbar-container">
    <a href="{{ route('perfil') }}">Perfil</a>
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

<!-- Layout Principal -->
<div id="tudo">
  <div id="conteutoglobal">
    <!-- Título -->
    
      <div class="titulo">Avaliar Anime: {{ $anime->titulo }}</div>
    


      <!-- Card do Anime -->
      <div class="postagem">
        <img 
          src="{{ asset(str_replace('public/', 'storage/', $anime->imagem_url)) }}" 
          class="card-img-top" 
          alt="{{ $anime->titulo }}">
        <h2>{{ $anime->titulo }}</h2>
        <p>{{ $anime->resumo }}</p>
        <p><strong>Lançamento:</strong> {{ $anime->data_lancamento }}</p>
      </div>


    <!-- Formulário de Avaliação -->
    @if(!$anime->usuarios()->where('idUsuario', auth()->id())->exists())
        <form action="{{ route('anime.salvarAvaliacoes', $anime->id) }}" method="POST" id="form-avaliacao">
          @csrf
          <label for="nota" class="form-label">Nota</label>
          <input type="number" name="nota" id="nota" class="form-control" min="1" max="5" required>

          <label for="opiniao" class="form-label">Sua Opinião</label>
          <textarea name="opiniao" id="opiniao" class="form-control" rows="4" required></textarea>

          <button type="submit" class="btn-primary">Enviar Avaliação</button>
        </form>
      @else
        <!-- Avaliação Existente -->
        @php
          $avaliacao = $anime->usuarios()->where('idUsuario', auth()->id())->first();
        @endphp
        <div class="alert">
          <h5>Avaliação Já Feita:</h5>
          <p><strong>Nota:</strong> {{ $avaliacao->pivot->NotaAnime }}</p>
          <p><strong>Opinião:</strong> {{ $avaliacao->pivot->Opinião }}</p>
        </div>
      @endif

      <!-- Mensagem de Sucesso -->
      @if(session('success'))
        <div class="alert alert-success mt-3">
          {{ session('success') }}
        </div>
      @endif
  </div>
</div>

<script src="{{ asset('js/iniciar.js') }}"></script>
</body>
</html>
