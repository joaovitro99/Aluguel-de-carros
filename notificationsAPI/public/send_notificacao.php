
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio Manual de Email</title>
    <link rel="stylesheet" href="/../Aluguel-de-carros/notificationsAPI/public/assets/css/style.css"> <!-- Incluindo o CSS -->
</head>
<body>
    <h1>Enviar Email</h1>
    <form action="" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" required></textarea><br><br>

        <input type="submit" value="Enviar Email">
        <?php if (!empty($_SESSION['statusMessage'])): ?>
            <div class="status-message <?php echo $_SESSION['statusClass']; ?>">
                <?php echo $_SESSION['statusMessage']; ?>
            </div>
            <?php 
            // Limpa a mensagem de status da sessão
            unset($_SESSION['statusMessage']);
            unset($_SESSION['statusClass']);
            ?>
        <?php endif; ?>
    </form>
</body>
</html>
