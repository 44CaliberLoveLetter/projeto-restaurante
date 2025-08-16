<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
  header("Location: login.php");
  exit;
}

require_once "conexao.php";

$sql = "SELECT id, nome_cliente, data_reserva, hora_reserva, id_mesa FROM reservas ORDER BY data_reserva";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel do Administrador</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="estilo.css">

  <style>
    body {
      background: linear-gradient(to right, #673ab7, #3f51b5);
      color: #fff;
      padding: 20px;
      min-height: 100vh;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      padding: 30px;
      max-width: 900px;
      margin: auto;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .btn-primary, .btn-danger, .btn-warning {
      border-radius: 12px;
    }

    .table {
      background-color: rgba(255,255,255,0.95);
      color: #333;
      border-radius: 8px;
      overflow: hidden;
    }

    a.btn {
      margin-right: 5px;
    }

    .btn-nova {
      display: inline-block;
      margin-bottom: 20px;
    }

    .btn-logout {
      margin-top: 30px;
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Reservas Feitas</h2>

    <a href="nova_reserva.php" class="btn btn-success btn-nova">➕ Nova Reserva</a>

    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-primary">
          <tr>
            <th>Nome</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Mesa</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['nome_cliente']) ?></td>
              <td><?= $row['data_reserva'] ?></td>
              <td><?= $row['hora_reserva'] ?></td>
              <td><?= $row['id_mesa'] ?></td>
              <td>
                <a href="editar_reserva.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                <a href="excluir_reserva.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">🗑️ Excluir</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <a href="logout.php" class="btn btn-outline-light btn-logout">Sair</a>
  </div>
</body>
</html>
