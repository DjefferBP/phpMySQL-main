<?php
session_start();
if (!isset($_SESSION["usuario"])) {
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

$nome_usuario = $_SESSION['usuario']["nome_usuario"];
$nivel_acesso = $_SESSION['usuario']["nivel_acesso"];

$stmt = $pdo->query('SELECT COUNT(DISTINCT tb_maquinas.tipo_maquina) as total_maquinas FROM tb_maquinas');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_maquinas = $row['total_maquinas'];

$stmt = $pdo->query('SELECT * FROM tb_maquinas GROUP BY(tipo_maquina);');
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
$maquinas = $row;

$stmt = $pdo->query('SELECT id_maquina, tag_maquina from tb_maquinas GROUP BY(id_maquina);');
$maquinas_disponiveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="listacss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="trocar_label.js"></script>
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


        <?php include "relatorios_insert.php";?>

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
        <div class="modal fade" id="modalCadastroUsuario" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">CADASTAR USUÁRIO</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" method="POST" action="cadastro-usuario.php">
                            <p class="title">CADASTRO</p>
                            <p class="message">Cadastre um novo usuário para o sistema.</p>
                            <label>
                                <input required="" class="input" name="nome" type="text">
                                <span>NOME</span>
                            </label>
                            <label>
                                <input required="" class="input" name="login" type="text">
                                <span>LOGIN ÚNICO</span>
                            </label>
                            <label>
                                <input required="" class="input" name="senha" type="password">
                                <span>SENHA</span>
                            </label>
                            <select name="acesso">
                                <option value="operador">Operador</option>
                                <option value="gerente">Gerente</option>
                            </select>
                            <button class="submit">Salvar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCadastroMaquina" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">CADASTRAR MÁQUINA</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" method="POST" action="cadastro-maquina.php">
                            <p class="title">CADASTRO</p>
                            <p class="message">Cadastre uma nova Máquina para o sistema.</p>
                            <label>
                                <input required="" class="input" name="tag" type="text">
                                <span>Digite a TAG da máquina</span>
                            </label>
                            <label>
                                <input required="" class="input" name="tipo" type="text" id="tipo_maquina">
                                <span>Digite o tipo da maquina ou selecione abaixo</span>
                            </label>
                            <select onchange="atualizarCampos()" id="lista_tipos">
                                <?php
                            foreach($maquinas as $maquina){
                                echo "<option name='tipo'>".$maquina['tipo_maquina']."</option>";
                            }
                            ?>
                            </select>


                            <button class="submit">Salvar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCadastroProducao" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">CADASTRAR PRODUÇÃO</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" method="POST" action="cadastro-producao.php">
                            <p class="title">CADASTRO</p>
                            <p class="message">Cadastre uma nova produção para o sistema.</p>
                            <span>MÁQUINA</span>
                            <select name="id_maquina" id="">
                                <?php foreach($maquinas_disponiveis as $maquina): ?>
                                <option value="<?= $maquina['id_maquina'] ?>"><?= $maquina['tag_maquina'] ?></option>
                                <?php endforeach; ?>
                            </select>


                            <label>
                                <input required="" class="input" name="qtd_produzida" type="number">
                                <span>QUANTIDADE PRODUZIDA</span>
                            </label>
                            <label>
                                <input required="" class="input" name="data_producao" type="date">
                                <span>DATA DA PRODUCÃO</span>
                            </label>
                            <select name="turno">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                            <button class="submit">Salvar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>