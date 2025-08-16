<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
  header("Location: login.php");
  exit;
}

require_once "conexao.php";

if (!isset($_GET['id'])) {
  header("Location: admin.php");
  exit;
}

$id = $_GET['id'];
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $data = $_POST["data"];
  $hora = $_POST["hora"];
  $mesa = $_POST["mesa"];

  $stmt = $conn->prepare("UPDATE reservas SET nome_cliente=?, data_reserva=?, hora_reserva=?, id_mesa=? WHERE id=?");
  $stmt->bind_param("sssii", $nome, $data, $hora, $mesa, $id);

  if ($stmt->execute()) {
    $mensagem = "Reserva atualizada com sucesso!";
  } else {
    $mensagem = "Erro ao atualizar reserva.";
  }
}

$stmt = $conn->prepare("SELECT * FROM reservas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$reserva = $res->fetch_assoc();

if (!$reserva) {
  header("Location: admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Reserva</title>
  <!-- Bootstrap 5 -->
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

    .form-control, .form-select {
      border-radius: 12px;
      margin-bottom: 15px;
    }

    .btn-primary {
      border-radius: 12px;
      width: 100%;
    }

    .btn-back {
      display: block;
      margin-top: 20px;
      text-align: center;
    }

    .alert {
      border-radius: 12px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4 text-center">Editar Reserva</h2>

    <?php if ($mensagem): ?>
      <div class="alert alert-info text-center"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">
      <label class="form-label">Nome do Cliente:</label>
      <input type="text" name="nome" class="form-control" required value="<?= htmlspecialchars($reserva['nome_cliente']) ?>">

      <label class="form-label">Data da Reserva:</label>
      <input type="date" name="data" class="form-control" required value="<?= $reserva['data_reserva'] ?>">

      <label class="form-label">Hora da Reserva:</label>
      <input type="time" name="hora" class="form-control" required value="<?= $reserva['hora_reserva'] ?>">

      <label class="form-label">Mesa:</label>
      <select name="mesa" class="form-select" required>
        <option value="1" <?= $reserva['id_mesa'] == 1 ? 'selected' : '' ?>>Mesa 1 (2 pessoas)</option>
        <option value="2" <?= $reserva['id_mesa'] == 2 ? 'selected' : '' ?>>Mesa 2 (4 pessoas)</option>
        <option value="3" <?= $reserva['id_mesa'] == 3 ? 'selected' : '' ?>>Mesa 3 (2 pessoas)</option>
        <option value="4" <?= $reserva['id_mesa'] == 4 ? 'selected' : '' ?>>Mesa 4 (4 pessoas)</option>
        <!-- Adicione mais opções se necessário -->
      </select>

      <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
    </form>

    <a href="admin.php" class="btn-back text-white">← Voltar ao Painel</a>
  </div>
</body>
</html>
