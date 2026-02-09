<?php
session_start();
if (!isset($_SESSION["nome_usuario"])) {
    header("Location: index.html");
    exit();
}
include_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RELATORIO</title>
    <link rel="stylesheet" href="relatorio.css">
</head>
<body>
    <div class="container">
        <H1>RELATÓRIO DE PRODUÇÃO INDIVIDUAL DAS MÁQUINAS</H1>
        <a href="lista.php"><button class="voltar">VOLTAR</button></a>
        <table>
            <tr>
                <th>EQUIPAMENTO</th>
                <th>TIPO DA MAQUINA</th>
                <th>QUANTIDADE PRODUZIDA</th>
                <th>VEZES OPERADA</th>
            </tr>

            <?php
            $stmt = $pdo->query("
                SELECT m.tag_maquina as equipamento, m.tipo_maquina as tipo_maquina, sum(p.qtd_produzida) as volume_total, count(p.id_registro) as vezes_operada
                FROM tb_maquinas m
                INNER JOIN tb_producao p ON m.id_maquina = p.id_maquina GROUP BY(m.tag_maquina), m.tipo_maquina ORDER BY volume_total DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['equipamento'] . "</td>";
                echo "<td>" . $row['tipo_maquina'] . "</td>";
                echo "<td>" . $row['volume_total'] . "</td>";
                echo "<td>" . $row['vezes_operada'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>