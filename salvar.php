<?php
include_once("conexao.php");
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->execute([$nome, $email, $senha]);
if ($stmt->rowCount() > 0){
    echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = 'lista.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar usuário.'); window.location.href = 'index.php';</script>";
}
?>