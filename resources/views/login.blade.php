<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Estilos adicionais para centralizar o formulário */
    .login-container {
      max-width: 400px;
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <div class="container login-container">
    <h2 class="text-center mb-4">Login</h2>
    @if (session('aviso'))
    <div class="alert alert-warning">
        {{ session('aviso') }}
    </div>
    @endif
    <form action="{{url('/login')}}" method="post">
      @csrf 
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha" required>
      </div>
      <div class="d-grid mb-2">
        <button type="submit" class="btn btn-primary">Entrar</button>
      </div>
      <div class="d-grid">
        <a href="/register" class="btn btn-secondary">Cadastrar</a> <!-- Link para a página de cadastro -->
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
