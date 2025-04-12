<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento de Animes</title>
  <link rel="stylesheet" href="{{ asset('css/stylo.css') }}">
</head>
<body>

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




<div id="tudo">
  <!-- Logo -->
  <div id="logo">
    <img id="sapo" src="{{ asset('images/logoSapo.png') }}" alt="Logo" >
  </div>
  
  <div id="conteutoglobal">

  <div id="header-animes">
    <div class="titulo">Meus Animes Assistidos</div>
    <div id="destaques-container">Animes Recentes</div>
  </div>
  <!-- Conteúdo Principal -->
    <div id="conteudoTotal">
      <!-- Lista de Animes -->
      <div id="conteudo">
        <!-- Checar autenticação -->
        @auth
          @foreach($animesAvaliados->take(3) as $anime) <!-- Limita a 4 animes -->
            <div class="postagem">
              <h2>{{ $anime->titulo }}</h2> <!-- Título acima da imagem -->
              <a href="{{ route('anime.show', $anime->id) }}">
                <img 
                  src="{{ asset(str_replace('public/', 'storage/', $anime->imagem_url)) }}" 
                  class="card-img-top img-jotaro" 
                  alt="{{ $anime->titulo }}">
              </a>
              <p><span class="Categoria">Nota: {{ $anime->pivot->NotaAnime }}</span></p>
              <p>{{ $anime->pivot->Opinião }}</p>
              <a href="{{ route('anime.avaliar', $anime->id) }}">Ver Avaliação</a>
            </div>
          @endforeach

          @if($animesAvaliados->count() > 3) <!-- Exibe o botão "Ver Mais" se houver mais animes -->
            <div class="text-center ver-mais-container">
              <a href="{{ route('anime.todos') }}" class="btn-primary">Ver Mais</a>
            </div>
          @endif
        @endauth

        @guest
          <p>Para ver seus animes assistidos, você precisa estar logado.</p>
        @endguest
      </div>

      <!-- Destaques -->
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
  
<script src="{{ asset('js\iniciar.js') }}"></script>
</body>
</html>