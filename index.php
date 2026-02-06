
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>

<body>
    <div>
        <form class="form" method="POST">
            <p class="title">Cadastro </p>
            <p class="message">Cadastre-se agora para acessar a plataforma. </p>
            <label>
                <input required="" placeholder="" type="text" class="input" id="nome" name="nome">
                <span>Nome</span>
            </label>

            <label>
                <input required="" placeholder="" type="email" class="input" id="email" name="email">
                <span>Email</span>
            </label>

            <label>
                <input required="" placeholder="" type="password" class="input" id="senha" name="senha">
                <span>Senha</span>
            </label>
            <button class="submit">Cadastrar-se</button>
            <p class="signin">Já tem uma conta? Acesse o <a class="textologin" href="login.php">Login </a> </p>
        </form>
    </div>
</body>

</html>