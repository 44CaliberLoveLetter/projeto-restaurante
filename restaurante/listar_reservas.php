<?php
require_once "conexao.php";


$conn = new mysqli("localhost", "novo_user", "1234", "novo_user");

// Consulta todas as reservas com nome da mesa
$sql = "SELECT r.id, r.nome, r.telefone, r.data_reserva, r.hora_reserva, m.numero AS mesa_numero 
        FROM reservas r 
        JOIN mesas m ON r.mesa_id = m.id 
        ORDER BY r.data_reserva, r.hora_reserva";

$reservas = $conn->query($sql);
?>

<h2>Reservas</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Data</th>
        <th>Hora</th>
        <th>Mesa</th>
        <th>Ações</th>
    </tr>

    <?php while ($r = $reservas->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($r['nome']) ?></td>
        <td><?= htmlspecialchars($r['telefone']) ?></td>
        <td><?= $r['data_reserva'] ?></td>
        <td><?= $r['hora_reserva'] ?></td>
        <td><?= $r['mesa_numero'] ?></td>
        <td>
            <a href="editar_reserva.php?id=<?= $r['id'] ?>">Editar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
