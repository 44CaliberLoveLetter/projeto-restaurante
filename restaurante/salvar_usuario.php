<?php
$conn = new mysqli("localhost", "novo_user", "1234", "novo_user");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usuario = trim($_POST["usuario"]);
  $senha = $_POST["senha"];
  $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // <-- Nova linha

  // Verifica se já existe
  $verifica = $conn->prepare("SELECT id FROM usuarios WHERE usuario=?");
  $verifica->bind_param("s", $usuario);
  $verifica->execute();
  $verifica->store_result();

  if ($verifica->num_rows > 0) {
    echo "<link rel='stylesheet' href='estilo.css'><div class='container'>";
    echo "Usuário já existe. <a href=\'cadastro.php\'>Tente outro nome</a>";
    echo "</div>";
  } else {
    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $senha_hash); // <-- Alterado para $senha_hash

    if ($stmt->execute()) {
      header("Location: login.php");
    } else {
      echo "<link rel='stylesheet' href='estilo.css'><div class='container'>";
      echo "Erro ao cadastrar. <a href=\'cadastro.php\'>Tentar novamente</a>";
      echo "</div>";
    }
  }
}
?>