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
                <th>STATUS</th>
                <th>QUANTIDADE</th>
            </tr>

            <?php
            $stmt = $pdo->query("
                SELECT status_operacional, COUNT(status_operacional) as total 
                FROM tb_maquinas
                GROUP BY(status_operacional);");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['status_operacional'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>