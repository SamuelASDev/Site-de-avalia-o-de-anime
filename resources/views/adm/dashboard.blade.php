<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Gerenciamento de Animes</title>
  <link rel="stylesheet" href="{{ asset('css/stylo.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adm.css') }}">
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

  <div id="conteutoglobal">
  <div id="header-animes">
    <div class="titulo">Meus Animes Assistidos</div>
  </div>
    
    <!-- Tabela de Animes -->
<!-- Tabela de Animes -->
<table class="anime-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Título</th>
      <th>Categoria</th>
      <th>Ações</th>
    </tr>
    <tr>
      <!-- Primeira linha da tabela será o botão de cadastro -->
      <th colspan="4" style="text-align: center;">
        <a href="{{ route('anime.create') }}" class="btn-action btn-create">Cadastrar Novo Anime</a>
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach($animes as $anime)
      <tr>
        <td>{{ $anime->id }}</td>
        <td>{{ $anime->titulo }}</td>
        <td>{{ $anime->data_lancamento }}</td>
        <td>
          <a href="{{ route('anime.edit', $anime->id) }}" class="btn-action btn-edit">Editar</a>
          <a href="{{ route('anime.show', $anime->id) }}" class="btn-action btn-info">Info</a>
          <form action="{{ route('anime.destroy', $anime->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-action btn-delete">Remover</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

    
  </div>
</div>

<script src="{{ asset('js/iniciar.js') }}"></script>

</body>
</html>
