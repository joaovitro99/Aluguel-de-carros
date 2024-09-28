<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Login.css">
</head>

<body>
    <div id="container">
        <h2>Login</h2>
        <button>
            Voltar
        </button>
        <form action="../BackEnd/admin/VerificarLogin.php" method="POST" id="Login">
            <div class="form_login">
                <label for="nome_usuario">Nome do usuário:</label>
                <input type="text" id="nome_usuario" name="nome_usuario" required>
            </div> 

            <div class="form_login">
                <label for="senha">Senha:</label>
                <input type="text" id="senha_mail" name="senha" required>
            </div>
            <button id="senha">Esqueci minha senha</button>

            <button type="submit">Entrar</button>
        </form>

        <button id="cadastro">Ainda não sou cadastrado</button>
    </div>
    <script></script>
</body>
</html>