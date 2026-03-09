<?php
include_once("conexao.php");
$nome = $_POST["nome"] ?? '';
$login = $_POST['login'] ??'';
$senha = $_POST['senha'] ??'';
$acesso = $_POST['acesso'] ?? 'operador';

if($nome && $login && $senha && $acesso){
    $stmt = $pdo->prepare('INSERT INTO tb_usuarios(nome_usuario, login, senha, nivel_acesso) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nome, $login, $senha, $acesso]);
    header("Location: lista.php");
} else {

    echo "<script>alert('Algo deu errado. Tente novamente.'); window.location.href='lista.php';</script>";
}