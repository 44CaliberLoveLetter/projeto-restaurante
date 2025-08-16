<?php
session_start();
if (isset($_SESSION['usuario'])) {
  if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
    header("Location: admin.php");
  } else {
    header("Location: formulario.php");
  }
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Bootstrap 5 CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #009688, #00796b);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
      position: relative;
    }

    .card-login {
      background-color: white;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card-login h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .form-control {
      margin-bottom: 20px;
      border-radius: 8px;
    }

    .btn-login {
      background-color: #009688;
      color: white;
      font-weight: bold;
      width: 100%;
      border-radius: 10px;
      padding: 10px;
      transition: background 0.3s ease;
    }

    .btn-login:hover {
      background-color: #00796b;
    }

    .cadastro-link {
      text-align: center;
      margin-top: 15px;
    }

    .cadastro-link a {
      color: #00796b;
      text-decoration: none;
      font-weight: 500;
    }

    .cadastro-link a:hover {
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

  <div class="card-login">
    <h2><i class="bi bi-box-arrow-in-right"></i> Login</h2>
    <form method="post" action="validar_login.php">
      <input type="text" name="usuario" class="form-control" placeholder="Usuário" required>
      <input type="password" name="senha" class="form-control" placeholder="Senha" required>
      <input type="hidden" name="login_type" value="admin">
      <button type="submit" class="btn btn-login">
        <i class="bi bi-door-open-fill"></i> Entrar
      </button>
    </form>
    <div class="cadastro-link">
      Ainda não tem conta? <a href="cadastro.php">Criar uma</a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
