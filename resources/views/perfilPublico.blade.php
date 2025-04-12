<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil do Usuário</title>
  <link rel="stylesheet" href="{{ asset('css/stylo.css') }}">
  <style>
    .img-perfil {
        width: 150px;
        height: 150px;
        border-radius: 50%; /* Imagem circular */
        object-fit: cover; /* Ajusta a imagem dentro do espaço disponível */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra leve */
        margin-top: -4.2%;
    }

    #perfil-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        margin: 20px auto;
        max-width: 800px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #perfil-info {
        text-align: left;
    }

    #titulo {
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

  input[type="file"] {
    margin-top: 10px;
}

.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-align: center;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.alert {
    margin: 10px auto;
    padding: 10px;
    border-radius: 5px;
    max-width: 800px;
    text-align: center;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

@media (max-width: 768px) {
    #perfil-container {
        flex-direction: column; /* Alinha itens verticalmente em telas menores */
        text-align: center; /* Centraliza o conteúdo */
    }

    #perfil-foto,
    #perfil-info {
        flex: 1 1 auto; /* Permite que os itens se ajustem ao tamanho disponível */
    }

    .img-perfil {
        width: 120px; /* Reduz o tamanho da imagem em telas menores */
        height: 120px;
    }

    #perfil-info h2 {
        font-size: 1.5em; /* Ajusta o tamanho do texto */
    }
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
    <div id="logo">
    <img id="sapo" src="{{ asset('images/logoSapo.png') }}" alt="Logo" >
  </div>

  <!-- Mensagens de Sucesso ou Erro -->
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <!-- Título dos Animes -->
  <div id="conteutoglobal">
      <!-- Foto de Perfil -->
      <div id="perfil-container">
  <div id="perfil-foto">
    <img 
      src="{{ asset(str_replace('public/', 'storage/', $user->imagem_perfil)) }}" 
      class="img-perfil" 
      alt="Foto de perfil de {{ $user->name }}">
  </div>
  <div id="perfil-info">
    <h2>{{ $user->name }}</h2>
    <p>Email: {{ $user->email }}</p>
  </div>
    </div>
    <div id="header-animes">
      <div id="titulo">Meus Animes Avaliados</div>
    </div>

    <!-- Lista de Animes Avaliados -->
    <div id="conteudoTotal">
      <div id="conteudo">
        @foreach($animesAvaliados as $anime)
          <div class="postagem">
            <h2>{{ $anime->titulo }}</h2>
            <a href="{{ route('anime.show', $anime->id) }}">
              <img 
                src="{{ asset(str_replace('public/', 'storage/', $anime->imagem_url)) }}" 
                class="card-img-top img-jotaro" 
                alt="{{ $anime->titulo }}">
            </a>
            <p><strong>Nota:</strong> {{ $anime->pivot->NotaAnime }}</p>
            <p><strong>Opinião:</strong> {{ $anime->pivot->Opinião }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/iniciar.js') }}"></script>
</body>
</html>




