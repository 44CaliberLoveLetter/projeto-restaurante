<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID da reserva não fornecido.");
}

$id_reserva = intval($_GET['id']);
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM reservas WHERE id = ? AND id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_reserva, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Reserva não encontrada ou acesso negado.");
}

$reserva = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Reserva</title>

  <!-- Bootstrap e Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #26a69a, #00796b);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .form-container {
      background: #ffffff;
      padding: 35px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 500px;
      animation: fadeIn 0.4s ease-in-out;
      position: relative;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.96); }
      to { opacity: 1; transform: scale(1); }
    }

    h2 {
      color: #00796b;
      margin-bottom: 25px;
      text-align: center;
    }

    label {
      font-weight: 600;
      margin-top: 12px;
      display: block;
    }

    input, select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-top: 5px;
      margin-bottom: 10px;
      font-size: 15px;
    }

    .btn-atualizar {
      width: 100%;
      background-color: #009688;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 10px;
      font-weight: bold;
      font-size: 16px;
      transition: background 0.3s ease;
      margin-top: 15px;
    }

    .btn-atualizar:hover {
      background-color: #00796b;
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
  </style>
</head>
<body>

  <a href="minhas_reservas.php" class="voltar" title="Voltar para minhas reservas">
    <i class="bi bi-arrow-left-circle-fill"></i>
  </a>

  <div class="form-container">
    <h2>Editar Reserva</h2>

    <form method="post" action="atualizar_reserva.php">
      <input type="hidden" name="id" value="<?= $reserva['id'] ?>">

      <label>Nome:</label>
      <input type="text" name="nome" value="<?= htmlspecialchars($reserva['nome_cliente']) ?>" required>

      <label>Telefone:</label>
      <input type="text" name="telefone" value="<?= htmlspecialchars($reserva['telefone']) ?>" required>

      <label>Data:</label>
      <input type="date" name="data_reserva" value="<?= $reserva['data_reserva'] ?>" required>

      <label>Hora:</label>
      <input type="time" name="hora_reserva" value="<?= $reserva['hora_reserva'] ?>" required>

      <label>Mesa:</label>
      <select name="id_mesa" required>
        <?php
        $mesas = $conn->query("SELECT id, numero FROM mesas ORDER BY numero");
        while ($mesa = $mesas->fetch_assoc()) {
            $selected = ($mesa['id'] == $reserva['id_mesa']) ? "selected" : "";
            echo "<option value='{$mesa['id']}' $selected>Mesa {$mesa['numero']}</option>";
        }
        ?>
      </select>

      <button type="submit" class="btn-atualizar">Atualizar Reserva</button>
    </form>
  </div>

  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
