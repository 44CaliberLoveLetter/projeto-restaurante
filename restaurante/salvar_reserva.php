<?php
session_start();

$conn = new mysqli("localhost", "novo_user", "1234", "novo_user"); // Banco 'restaurante'

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    die("Usuário não autenticado. Por favor, faça login.");
}

$id_usuario = $_SESSION['id_usuario'];

// Pegando os dados do formulário
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$data = $_POST['data_reserva'];
$hora = $_POST['hora_reserva'];
$id_mesa = $_POST['id_mesa'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado da Reserva</title>

  <!-- Bootstrap 5 CSS + Icons -->
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

    .card-result {
      background: #fff;
      padding: 40px 30px;
      border-radius: 18px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
      max-width: 480px;
      width: 100%;
      animation: fadeIn 0.4s ease-in-out;
      text-align: center;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    .card-result h2 {
      color: #00796b;
      margin-bottom: 20px;
    }

    .btn-voltar {
      background-color: #009688;
      border: none;
      color: #fff;
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: bold;
      transition: background 0.3s ease;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
    }

    .btn-voltar:hover {
      background-color: #00695c;
    }

    .msg-erro {
      color: #c62828;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="card-result">
    <?php
    // Verifica se a data é passada
    if (strtotime($data) < strtotime(date('Y-m-d'))) {
        echo "<div class='msg-erro'><i class='bi bi-x-circle-fill'></i> Não é possível reservar datas passadas.</div>";
    } else {
        // Verifica se já existe reserva para essa mesa, data e hora
        $sql = "SELECT * FROM reservas WHERE data_reserva = ? AND hora_reserva = ? AND id_mesa = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $data, $hora, $id_mesa);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='msg-erro'><i class='bi bi-exclamation-triangle-fill'></i> Já existe uma reserva para essa mesa nesse horário.</div>";
        } else {
            // Inserir reserva com id_usuario
            $sql = "INSERT INTO reservas (nome_cliente, telefone, data_reserva, hora_reserva, id_mesa, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssii", $nome, $telefone, $data, $hora, $id_mesa, $id_usuario);

            if ($stmt->execute()) {
                echo "<h2><i class='bi bi-check-circle-fill'></i> Reserva realizada com sucesso!</h2>";
            } else {
                echo "<div class='msg-erro'><i class='bi bi-x-circle-fill'></i> Erro ao salvar a reserva.</div>";
            }
        }
    }
    ?>
    <a href="formulario.php" class="btn-voltar"><i class="bi bi-arrow-left"></i> Voltar</a>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
