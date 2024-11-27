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
        <form action="/aluguel-de-carros/public/user/forgotPassword" method="POST" id="forgot-password-form">
            <div class="form_login">
                <label for="email">Digite seu e-mail para redefinir a senha:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Redefinir senha </button>
        </form>
         <!-- Mensagens de feedback -->
         <div id="message" class="form_login"></div>
    </div>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const messageDiv = document.getElementById('message');

        if (urlParams.has('success')) {
            messageDiv.textContent = "Um link foi enviado para o seu e-mail.";
            messageDiv.style.color = "green";
        } else if (urlParams.has('error')) {
            const error = urlParams.get('error');
            if (error === 'invalid') {
                messageDiv.textContent = "E-mail inválido. Tente novamente.";
                messageDiv.style.color = "red";
            }
        }
    </script>
</body>

</html>
