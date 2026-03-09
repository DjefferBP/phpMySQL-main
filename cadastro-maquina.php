<?php
include_once("conexao.php");
$tag = $_POST["tag"] ?? '';
$tipo = $_POST['tipo'] ??'';


if($tag && $tipo){
    $stmt = $pdo->prepare('INSERT INTO tb_maquinas(tag_maquina, tipo_maquina) VALUES (?, ?)');
    $stmt->execute([$tag, $tipo]);
    header("Location: lista.php");
} else {

    echo "<script>alert('Algo deu errado. Tente novamente.'); window.location.href='lista.php';</script>";
}