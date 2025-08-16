<?php
require_once "conexao.php";

$conn = new mysqli("localhost", "novo_user", "1234", "novo_user");
$mesas = $conn->query("SELECT * FROM mesas ORDER BY numero");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Nova Reserva</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #009688, #00796B);
      color: #fff;
      padding: 20px;
      min-height: 100vh;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      padding: 40px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
      animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-label {
      margin-top: 10px;
      font-weight: bold;
    }

    .form-control, .form-select {
      border-radius: 12px;
      margin-bottom: 15px;
    }

    .btn-primary {
      border-radius: 12px;
      width: 100%;
      font-weight: bold;
      letter-spacing: 0.5px;
    }

    .btn-logout {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: #fff;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Reservar uma Mesa</h2>

    <form action="salvar_reserva.php" method="post">
      <label class="form-label">Nome:</label>
      <input type="text" name="nome" class="form-control" required>

      <label class="form-label">Telefone:</label>
      <input type="text" name="telefone" class="form-control">

      <label class="form-label">Data:</label>
      <input type="date" name="data_reserva" class="form-control" required>

      <label class="form-label">Hora:</label>
      <input type="time" name="hora_reserva" class="form-control" required>

      <label class="form-label">Mesa:</label>
      <select name="id_mesa" class="form-select" required>
        <?php while ($m = $mesas->fetch_assoc()): ?>
          <option value="<?= $m['id'] ?>">Mesa <?= $m['numero'] ?> (<?= $m['capacidade'] ?> pessoas)</option>
        <?php endwhile; ?>
      </select>

      <button type="submit" class="btn btn-primary mt-3">Reservar</button>
    </form>

    <a href="logout.php" class="btn-logout">← Sair</a>
        <p style="text-align:center;margin-top:10px;">
      <a href="minhas_reservas.php">Ver Minhas Reservas</a>
    </p>
  </div>
</body>
</html>
