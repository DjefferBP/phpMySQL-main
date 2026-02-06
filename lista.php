<?php
include_once("conexao.php");
$stmt = $pdo->query('SELECT count(*) as total_ativo from tb_maquinas where tb_maquinas.status_operacional="ativo"');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_ativo = $row['total_ativo'];

$stmt = $pdo->query("select sum(tb_producao.qtd_produzida) as total_produzido from tb_producao");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_produzido = $row["total_produzido"];
$stmt = $pdo->query("select avg(tb_producao.qtd_produzida) as media_aritmetica from tb_producao");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$media_aritmetica = $row["media_aritmetica"];   
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
        <h1>INDÚSTRIA AUTOMOTIVA</h1>
        <a href="relatorio.php"><button class="relatorio">RELATÓRIO</button></a>
        
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
                <h3>DADOS 3</h3>
            </div>
        </div>
    </div>
</body>
</html>
