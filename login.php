
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div>
        <form class="form" method="POST" >
            <p class="title">Login</p>
            <p class="message">Entre com suas credenciais para acessar a plataforma.</p>
            <label>
                <input required="" placeholder="" type="email" class="input" id="email" name="email">
                <span>Email</span>
            </label>
            <label>
                <input required="" placeholder="" type="password" class="input" id="senha" name="senha">
                <span>Senha</span>
            </label>
            <button class="submit">Login</button>
            <p class="signin">Não tem uma conta? Acesse o <a class="textologin" href="index.php">Cadastro </a> </p>
        </form>
    </div>
</body>
</html>