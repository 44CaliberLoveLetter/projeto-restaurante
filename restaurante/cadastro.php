<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Usuário</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #673ab7, #512da8);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
      position: relative;
    }

    .card-cadastro {
      background-color: white;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      animation: fadeIn 0.5s ease-in-out;
      position: relative;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card-cadastro h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .form-control {
      margin-bottom: 20px;
      border-radius: 8px;
    }

    .btn-cadastrar {
      background-color: #673ab7;
      color: white;
      font-weight: bold;
      width: 100%;
      border-radius: 10px;
      padding: 10px;
      transition: background 0.3s ease;
    }

    .btn-cadastrar:hover {
      background-color: #5e35b1;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
    }

    .login-link a {
      color: #673ab7;
      text-decoration: none;
      font-weight: 500;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    .voltar {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 24px;
      color: white;
      text-decoration: none;
      transition: transform 0.2s ease;
    }

    .voltar:hover {
      transform: translateX(-4px);
      color: #e0e0e0;
    }

    @media (max-width: 450px) {
      .voltar {
        font-size: 20px;
        top: 15px;
        left: 15px;
      }
    }
  </style>
</head>
<body>

  <!-- Botão de voltar -->
  <a href="index.php" class="voltar" title="Voltar para a tela inicial">
    <i class="bi bi-arrow-left-circle-fill"></i>
  </a>

  <div class="card-cadastro">
    <h2><i class="bi bi-person-plus-fill"></i> Criar Conta</h2>
    <form action="salvar_usuario.php" method="post">
      <input type="text" name="usuario" class="form-control" placeholder="Usuário" required>
      <input type="password" name="senha" class="form-control" placeholder="Senha" required>
      <button type="submit" class="btn btn-cadastrar">
        <i class="bi bi-check-circle"></i> Cadastrar
      </button>
    </form>
    <div class="login-link">
      Já tem conta? <a href="login.php">Fazer login</a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
