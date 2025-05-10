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
      <div class="titulo" id="animeTab" onclick="showAnimes()">Animes</div>
      <div class="titulo" id="usuarioTab" onclick="showUsuarios()">Usuários</div>
    </div>

        <!-- Exibição de mensagens de sucesso ou erro -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    <!-- Seção de Animes -->
    <div id="animeSection">
      <table class="anime-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Título</th>
            <th>Categoria</th>
            <th>Ações</th>
          </tr>
          <tr>
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

    <!-- Seção de Usuários -->
    <div id="usuarioSection" style="display: none;">
      <table class="usuario-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Nível</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuarios as $usuario)
            <tr>
              <td>{{ $usuario->id }}</td>
              <td>{{ $usuario->name }}</td>
              <td>{{ $usuario->email }}</td>
              <td>{{ $usuario->nivel }}</td>
              <td>
                <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn-action btn-edit">Editar</a>
                <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn-action btn-info">Perfil</a>
                <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" style="display:inline;">
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
</div>

<script src="{{ asset('js/iniciar.js') }}"></script>

<script>
  // Função para exibir a seção de Animes
  function showAnimes() {
    document.getElementById('animeSection').style.display = 'block';
    document.getElementById('usuarioSection').style.display = 'none';
    document.getElementById('animeTab').classList.add('active');
    document.getElementById('usuarioTab').classList.remove('active');
  }

  // Função para exibir a seção de Usuários
  function showUsuarios() {
    document.getElementById('animeSection').style.display = 'none';
    document.getElementById('usuarioSection').style.display = 'block';
    document.getElementById('usuarioTab').classList.add('active');
    document.getElementById('animeTab').classList.remove('active');
  }

  // Exibe Animes por padrão ao carregar a página
  window.onload = showAnimes;
</script>

</body>
</html>
