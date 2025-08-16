<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
  header("Location: login.php");
  exit;
}

require_once "conexao.php";

if (!isset($_GET['id'])) {
  echo "ID não especificado.";
  exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM reservas WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  header("Location: admin.php");
  exit;
} else {
  echo "Erro ao excluir reserva.";
}
?>
