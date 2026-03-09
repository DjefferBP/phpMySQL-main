<?php

include_once("conexao.php");
$id_maquina = $_POST["id_maquina"];
$qtd_produzida = $_POST["qtd_produzida"];
$data_producao = $_POST["data_producao"];
$turno = $_POST["turno"];

if (strtotime($data_producao) > strtotime(date('Y-m-d'))) {
    echo "<script>alert('Data de produção inválida. Tente novamente.'); window.location.href='lista.php';</script>";
    exit;
}

if ($qtd_produzida <= 0) {
    echo "<script>alert('Quantidade produzida deve ser maior que zero. Tente novamente.'); window.location.href='lista.php';</script>";
    exit;
}

if ($id_maquina && $qtd_produzida && $data_producao && $turno) {
    $stmt = $pdo->prepare('INSERT INTO tb_producao(id_maquina, qtd_produzida, data_producao, turno) VALUES (?, ?, ?, ?)');
    $stmt->execute([$id_maquina, $qtd_produzida, $data_producao, $turno]);
    header("Location: lista.php");
} else {
    echo "<script>alert('Algo deu errado. Tente novamente.'); window.location.href='lista.php';</script>";
}