<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status da Redefinição de Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            margin: 20px 0;
        }
        .success {
            color: #4CAF50;
        }
        .error {
            color: #F44336;
        }
        button {
            padding: 10px;
            background-color: #3A98AC;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #2e7a85;
        }
    </style>
</head>
<body>

    <div class="container">
        <p class="status-message <?php echo isset($statusClass) ? $statusClass : ''; ?>">
            <?php
                // Exibir mensagem com base no status do processo
                if (isset($statusMessage)) {
                    echo $statusMessage;
                }
            ?>
        </p>
        <a href="/aluguel-de-carros/public/login/index"><button>Voltar para Login</button></a>
    </div>

</body>
</html>
