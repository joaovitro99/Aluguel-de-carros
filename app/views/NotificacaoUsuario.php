<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            flex-direction: column;
            margin: 20px;
        }
        .header {
            color: white;
            padding: 20px;
            text-align: center;
            height: 20vh;
        }

        .container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 80vh;
            border-radius: 20%;
        }

        .retangulo-azul {
            border: 1px solid #747171;
            background-color: #007b95;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .retangulo-azul div {
            color: white;
            font-size: 18px;
            margin-right: 20px;
            cursor: pointer;
        }

        #notifications {
            margin-top: 20px;
            width: 100%;
            max-width: 600px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .notification-item {
            border-bottom: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: #fff;
        }

        .notification-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <?php
        session_start();

        // Verifica se o usuário está logado
        if (!isset($_SESSION['id_cliente'])) {
            echo "<script>alert('Você precisa estar logado para acessar as notificações.'); window.location.href = 'login.php';</script>";
            exit();
        }

        // Acessa os dados do usuário logado
        $id_cliente = $_SESSION['id_cliente'];
    ?>

    <div class="header">
        <div class="retangulo-azul">
            <a href="pagina_inicial.php"><div class="home">Home</div></a>
            <a href="BuscaCarros.php"><div class="nossos-veiculos">Nossos veículos</div></a>
            <a href="pagina_inicial.php"><div class="sobre-nos">Sobre-nós</div></a>
            <a href="perfil.php"><div class="sobre-nos">Perfil</div></a>
        </div>
    </div>

    <h1>Notificações</h1>

    <input type="hidden" id="clientId" value="<?= htmlspecialchars((string)$id_cliente, ENT_QUOTES, 'UTF-8'); ?>">


    <div id="notifications">
        <h3>Suas Notificações</h3>
        <p>Carregando notificações...</p>
    </div>

    <div id="notifications">
    <h3>Suas Notificações</h3>
    <?php if (!empty($notificacoes_cliente)): ?>
        <?php foreach ($notificacoes_cliente as $notificacao): ?>
            <div class="notification-item">
                <p><strong>Mensagem:</strong> <?= htmlspecialchars($notificacao['message'], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Data:</strong> <?= htmlspecialchars(date("d/m/Y H:i", strtotime($notificacao['data_envio'])), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Sem notificações encontradas para você.</p>
    <?php endif; ?>
    </div>

</body>
</html>

