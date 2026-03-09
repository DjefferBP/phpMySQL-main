<?php
echo '<link rel="stylesheet" href="listacss.css">';
echo "<div class='relatorios'>
    <a href='relatorio.php'><button class='relatorio'>RELATÓRIO GERAL</button></a>
    <a href='relatorio_maquina.php'><button class='relatorio'>RELATÓRIO INDIVIDUAL</button></a>";

    echo "<div class='cadastro-buttons'>";
    if ($_SESSION['usuario']['nivel_acesso'] === 'gerente' || $_SESSION['usuario']['nivel_acesso'] === 'admin') {
        echo '<button class=\"buttons-cadastro\" data-bs-toggle=\"modal\" data-bs-target=\"#modalCadastroUsuario\">CADASTRAR USUÁRIO</button>';
        echo '<button class=\"buttons-cadastro\" data-bs-toggle=\"modal\" data-bs-target=\"#modalCadastroMaquina\">CADASTRAR MÁQUINA</button>';
        echo '<button class=\"buttons-cadastro\" data-bs-toggle=\"modal\" data-bs-target=\"#modalCadastroProducao\">CADASTRAR PRODUÇÃO</button>';
    }
    echo "</div>";
    
echo "</div>";
?>