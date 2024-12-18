<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/assets/css/Login.css">
</head>

<body>
    <div id="container">
        <h2>Login</h2>
        <form action="/aluguel-de-carros/public/login/verificar" method="POST" id="Login">
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

        <a href="/aluguel-de-carros/public/user/signup"><button id="cadastro">Ainda não sou cadastrado</button></a>
        <div>
            <a href="/aluguel-de-carros/public/user/forgotPassword">
                <button id="forgot-password-btn">Esqueci minha senha</button>
            </a>
        </div>
    </div>
    <script></script>
</body>
</html>