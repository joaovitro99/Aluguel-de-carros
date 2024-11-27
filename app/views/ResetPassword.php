<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="../../public/assets/css/Login.css">
</head>

<body>
    <div id="container">
        <h2>Redefinir Senha</h2>
        <form action="/aluguel-de-carros/public/user/updatePassword" method="POST" id="resetPassword" onsubmit="return validarSenhas()">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">

            <div class="form_login">
                <label for="new_password">Nova Senha:</label>
                <input type="password" name="new_password" id="new_password" required placeholder="Digite a nova senha">
            </div>

            <div class="form_login">
                <label for="confirm_password">Confirme a Senha:</label>
                <input type="password" name="confirm_password" id="confirm_password" required placeholder="Digite novamente a senha">
            </div>

            <div id="error-message" class="error-message" style="display:none;">As senhas não coincidem. Por favor, tente novamente.</div>

            <button type="submit">Redefinir Senha</button>
        </form>
    </div>
    
    <script>
        // Função para validar se as senhas coincidem
        function validarSenhas() {
            var senha = document.getElementById("new_password").value;
            var confirmarSenha = document.getElementById("confirm_password").value;

            if (senha !== confirmarSenha) {
                document.getElementById("error-message").style.display = "block";
                return false;
            }

            document.getElementById("error-message").style.display = "none";
            return true;
        }
    </script>
</body>

</html>
