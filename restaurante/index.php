<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bem-vindo</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Ícones Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f44336, #ff9800);
      color: #fff;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Segoe UI", sans-serif;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      padding: 40px 30px;
      max-width: 500px;
      width: 100%;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
      text-align: center;
      animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
      from { transform: translateY(40px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .card h2 {
      margin-bottom: 15px;
      color: #fff;
      font-weight: bold;
    }

    .btn-custom {
      background-color: #03a9f4;
      color: white;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.3s ease;
      width: 100%;
      padding: 12px;
      border-radius: 12px;
      border: none;
      font-size: 17px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .btn-custom:hover {
      background-color: #0288d1;
    }

    .lead {
      font-size: 18px;
      margin-bottom: 25px;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Bem-vindo!</h2>
    <p class="lead">Escolha como deseja prosseguir:</p>
    <div class="d-grid gap-3">
      <a href="login.php" class="btn btn-custom">
        <i class="bi bi-shield-lock-fill"></i> Login do Administrador
      </a>
      <a href="login_user.php" class="btn btn-custom">
        <i class="bi bi-calendar-plus"></i> Fazer uma Reserva (Cliente)
      </a>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
