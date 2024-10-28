<?php
require_once __DIR__ . '/../../app/controllers/RentalController.php';

$rentalController = new RentalController(); // Instancia a classe

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rentalController->enviarManualmente(); // Chama o método de envio manual
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio Manual de Email</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Incluindo o CSS -->
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
    </form>
</body>
</html>
