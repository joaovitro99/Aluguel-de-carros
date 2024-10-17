<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/Login.css">
</head>

<body>
    <div id="container">
        <h2>Login</h2>
        <form action="login/verificar" method="POST" id="Login">
    <div class="form_login">
        <label for="nome_usuario">Nome do usuário:</label>
        <input type="text" id="nome_usuario" name="nome_usuario" required>
    </div> 

    <div class="form_login">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
    </div>

    <button type="submit">Entrar</button>
</form>
        <a href="Cadastro.php"><button id="cadastro">Ainda não sou cadastrado</button></a>
    </div>
    <script></script>
</body>
</html>