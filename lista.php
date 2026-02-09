<?php
session_start();
if (!isset($_SESSION["nome_usuario"])) {
    header("Location: index.html");
    exit();
}
include_once("conexao.php");
$stmt = $pdo->query('SELECT count(*) as total_ativo from tb_maquinas where tb_maquinas.status_operacional="ativo"');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_ativo = $row['total_ativo'];

$stmt = $pdo->query("select sum(tb_producao.qtd_produzida) as total_produzido from tb_producao");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_produzido = $row["total_produzido"];
$stmt = $pdo->query("select ROUND(AVG(tb_producao.qtd_produzida), 2) as media_aritmetica from tb_producao");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$media_aritmetica = $row["media_aritmetica"];   

$nome_usuario = $_SESSION['nome_usuario'];
$nivel_acesso = $_SESSION['nivel_acesso'];

$stmt = $pdo->query('SELECT COUNT(DISTINCT tb_maquinas.tipo_maquina) as total_maquinas FROM tb_maquinas');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_maquinas = $row['total_maquinas'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="listacss.css">
    <title>EQUIPAMENTOS</title>
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <ul class="navbar-list">
                <li class="navbar-item">NOME: <?php echo $nome_usuario; ?></li>
                <li class="navbar-item">NÍVEL DE ACESSO: <?php echo ucfirst($nivel_acesso); ?></li>
                <li class="navbar-item"><a href="sair.php" class="navbar-link">SAIR</a></li>
            </ul>
        </nav>
        <h1>INDÚSTRIA AUTOMOTIVA</h1>
        <div class="relatorios">
            <a href="relatorio.php"><button class="relatorio">RELATÓRIO GERAL</button></a>
            <a href="relatorio_maquina.php"><button class="relatorio">RELATÓRIO INDIVIDUAL</button></a>
            <a href="relatorio_status.php"><button class="relatorio">RELATÓRIO DE STATUS</button></a>
            <a href="relatorio_turno.php"><button class="relatorio">RELATÓRIO DE TURNO</button></a>
        </div>
        
        <div class="info">
            <div class="container-ativo">
                <h3>ON-LINES</h3>
                <p><?php echo $total_ativo; ?></p>
                <h3>TOTAL PRODUZIDO</h3>
                <p><?php echo $total_produzido; ?></p>
            </div>
            
            <div class="eficiencia">
                <h3>TOTAL PRODUZIDO</h3>
                <p><?php echo $total_produzido; ?></p>
                <h3>MÉDIA POR LOTE</h3>
                
                <p><?php echo number_format($media_aritmetica, 2, ',', '.'); ?></p>
            </div>
            <div class="dados3">
                <h3>QUANTIDADE DE TIPOS DE MAQUINAS</h3>
                <p><?php echo $total_maquinas; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
