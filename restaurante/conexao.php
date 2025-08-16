<?php
$host = "localhost";
$usuario = "novo_user";
$senha = "1234";
$banco = "novo_user";

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica erro
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}
?>
