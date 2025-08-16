<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $login_type = $_POST["login_type"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario_bd = $resultado->fetch_assoc();

        // Comparação de senha com hash
        if (password_verify($senha, $usuario_bd["senha"])) { // <-- Alterado para password_verify()
            $_SESSION["usuario"] = $usuario_bd["usuario"];
            $_SESSION["tipo"] = $usuario_bd["tipo"];

            if ($login_type === "admin" && $_SESSION["tipo"] === "admin") {
                header("Location: admin.php");
            } elseif ($login_type === "client" && $_SESSION["tipo"] === "user") {
                header("Location: minhas_reservas.php");
            } else {
                session_destroy();
                if ($login_type === "admin") {
                    echo "Acesso negado para administradores nesta página de login.";
                } else {
                    echo "Acesso negado para clientes nesta página de login.";
                }
            }
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>