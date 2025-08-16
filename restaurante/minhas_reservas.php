<?php
session_start();
require_once "conexao.php";

// Pega o ID do usuário logado na sessão
$id_usuario = $_SESSION["id_usuario"] ?? null;

if (!$id_usuario) {
    // Se não tiver ID na sessão, redireciona para login
    header("Location: login.php");
    exit;
}

// Consulta as reservas do usuário logado pelo id_usuario
$sql = "SELECT r.id, r.nome_cliente, r.telefone, r.data_reserva, r.hora_reserva, m.numero AS mesa_numero, m.capacidade 
        FROM reservas r 
        JOIN mesas m ON r.id_mesa = m.id 
        WHERE r.id_usuario = ? 
        ORDER BY r.data_reserva, r.hora_reserva";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Minhas Reservas</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="estilo.css">
  <style>
    .container {
      max-width: 900px;
      margin-top: 40px;
    }

    table {
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px 16px;
      text-align: center;
    }

    th {
      background-color: #1e7e34;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .btn-voltar:hover {
      color: #155d27;
    }

    .actions a {
      margin: 0 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4">Minhas Reservas</h2>

    <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Mesa</th>
            <th>Capacidade</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row["nome_cliente"]) ?></td>
            <td><?= htmlspecialchars($row["telefone"]) ?></td>
            <td><?= $row["data_reserva"] ?></td>
            <td><?= $row["hora_reserva"] ?></td>
            <td><?= $row["mesa_numero"] ?></td>
            <td><?= $row["capacidade"] ?></td>
            <td class="actions">
              <a class="btn btn-sm btn-warning" href="editar_reserva_cliente.php?id=<?= $row["id"] ?>">Editar</a>
              <a class="btn btn-sm btn-danger" href="excluir_reserva_cliente.php?id=<?= $row["id"] ?>" onclick="return confirm('Tem certeza que deseja excluir esta reserva?');">Excluir</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <p>Você não possui reservas.</p>
    <?php endif; ?>

    <div class="mt-4 d-flex justify-content-between">
      <a href="formulario.php" class="btn btn-success">Fazer Nova Reserva</a>
      <a href="logout.php" class="btn btn-secondary">Sair</a>
    </div>
  </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
