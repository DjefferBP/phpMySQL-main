<?php
include_once("conexao.php");

$login_unico = $_POST["login"];
$senha = $_POST["senha"];
$stmt = $pdo->prepare("SELECT id_usuario, nome_usuario, nivel_acesso FROM tb_usuarios WHERE login = ? AND senha = ?");
$stmt->execute([$login_unico, $senha]);

if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    session_start();
    $_SESSION['id_usuario'] = $user['id_usuario'];
    $_SESSION['nome_usuario'] = $user['nome_usuario'];
    $_SESSION['nivel_acesso'] = $user['nivel_acesso'];

    header("Location: lista.php");
} else {
    // Login inválido, redirecionar de volta para a página de login com uma mensagem de erro
    echo "<script>alert('Login inválido. Tente novamente.'); window.location.href='index.html';</script>";
}