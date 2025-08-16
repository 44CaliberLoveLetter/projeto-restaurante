<?php
session_start();

// Redireciona se o usuário não estiver logado ou não for um cliente
if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "user") {
    header("Location: login.php");
    exit;
}

require_once "conexao.php";

$id = $_GET["id"] ?? null;
$usuario_logado = $_SESSION["usuario"];

echo 

if (!$id) {
    die("ID da reserva não informado.");
}

// Exclui a reserva, verificando se pertence ao usuário logado
$stmt = $conn->prepare("DELETE FROM reservas WHERE id = ? AND nome_cliente = ?");
$stmt->bind_param("is", $id, $usuario_logado);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<link rel=\'stylesheet\\' href=\'estilo.css\'><div class=\'container\'>";
        echo "Reserva excluída com sucesso. <a href=\'minhas_reservas.php\'>Voltar para Minhas Reservas</a>";
        echo "</div>";
    } else {
        echo "<link rel=\'stylesheet\\' href=\'estilo.css\'><div class=\'container\'>";
        echo "Reserva não encontrada ou você não tem permissão para excluí-la. <a href=\'minhas_reservas.php\'>Voltar para Minhas Reservas</a>";
        echo "</div>";
    }
} else {
    echo "<link rel=\'stylesheet\\' href=\'estilo.css\'><div class=\'container\'>";
    echo "Erro ao excluir reserva. <a href=\'minhas_reservas.php\'>Voltar para Minhas Reservas</a>";
    echo "</div>";
}

$stmt->close();
$conn->close();
?>