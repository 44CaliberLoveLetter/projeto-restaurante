<?php
session_start();

// Redireciona se o usuário não estiver logado ou não for um cliente
if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "user") {
    header("Location: login.php");
    exit;
}

require_once "conexao.php";

$id = $_POST["id"];
$nome = $_POST["nome"];
$telefone = $_POST["telefone"];
$data = $_POST["data_reserva"];
$hora = $_POST["hora_reserva"];
$id_mesa = $_POST["id_mesa"];
$usuario_logado = $_SESSION["usuario"];

echo 

// Verifica se a reserva pertence ao usuário logado
$verifica_usuario = $conn->prepare("SELECT id FROM reservas WHERE id = ? AND nome_cliente = ?");
$verifica_usuario->bind_param("is", $id, $usuario_logado);
$verifica_usuario->execute();
$result_usuario = $verifica_usuario->get_result();

if ($result_usuario->num_rows === 0) {
    die("Você não tem permissão para editar esta reserva.</div>");
}

// Verifica se a data é passada
if (strtotime($data) < strtotime(date("Y-m-d"))) {
    die("Não é possível reservar datas passadas.</div>");
}

// Verificar se já existe outra reserva com mesmo horário e mesa
$sql = "SELECT id FROM reservas 
        WHERE data_reserva=? AND hora_reserva=? AND id_mesa=? AND id<>?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $data, $hora, $id_mesa, $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Já existe uma reserva para essa mesa nesse horário.</div>");
}

// Atualizar
$sql = "UPDATE reservas SET nome_cliente=?, telefone=?, data_reserva=?, hora_reserva=?, id_mesa=? WHERE id=? AND nome_cliente=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssiss", $nome, $telefone, $data, $hora, $id_mesa, $id, $usuario_logado);

if ($stmt->execute()) {
    echo "Reserva atualizada com sucesso. <a href=\'minhas_reservas.php\'>Voltar para Minhas Reservas</a>";
} else {
    echo "Erro ao atualizar reserva.";
}

echo "</div>";
?>