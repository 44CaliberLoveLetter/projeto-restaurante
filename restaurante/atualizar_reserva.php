<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: minhas_reservas.php");
    exit;
}

if (!isset($_SESSION['id_usuario'])) {
    die("Usuário não autenticado.");
}

$id_usuario = $_SESSION['id_usuario'];

$id = intval($_POST['id']);
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$data = $_POST['data_reserva'];
$hora = $_POST['hora_reserva'];
$id_mesa = intval($_POST['id_mesa']);

// Verifica se o usuário tem permissão para atualizar esta reserva
$sql_check = "SELECT id FROM reservas WHERE id = ? AND id_usuario = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ii", $id, $id_usuario);
$stmt_check->execute();
$res_check = $stmt_check->get_result();

if ($res_check->num_rows !== 1) {
    die("Reserva não encontrada ou acesso negado.");
}

// Atualiza a reserva
$sql_update = "UPDATE reservas SET nome_cliente = ?, telefone = ?, data_reserva = ?, hora_reserva = ?, id_mesa = ? WHERE id = ? AND id_usuario = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("sssssii", $nome, $telefone, $data, $hora, $id_mesa, $id, $id_usuario);

if ($stmt_update->execute()) {
    header("Location: minhas_reservas.php");
    exit;
} else {
    echo "Erro ao atualizar a reserva.";
}
?>
