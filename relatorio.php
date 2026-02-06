<?php
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
        <H1>RELATÓRIO DE PRODUÇÃO</H1>
        <a href="lista.php"><button class="voltar">VOLTAR</button></a>
        <table>
            <tr>
                <th>TAG DA MAQUINA</th>
                <th>TIPO DA MAQUINA</th>
                <th>QUANTIDADE PRODUZIDA</th>
                <th>DATA DE PRODUÇÃO</th>
            </tr>

            <?php
            $stmt = $pdo->query("
                SELECT m.tag_maquina, m.tipo_maquina, p.qtd_produzida, p.data_producao
                FROM tb_maquinas m
                JOIN tb_producao p ON m.id_maquina = p.id_maquina
                ORDER BY p.data_producao DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['tag_maquina'] . "</td>";
                echo "<td>" . $row['tipo_maquina'] . "</td>";
                echo "<td>" . $row['qtd_produzida'] . "</td>";
                echo "<td>" . $row['data_producao'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>