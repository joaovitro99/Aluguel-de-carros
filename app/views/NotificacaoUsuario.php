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
        }
        .header {
            color: white;
            padding: 20px;
            text-align: center;
            height: 20vh;
            width:80%;
            align-items: center;
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
        .retangulo-azul > a {
            text-decoration: none;
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
       

        // Verifica se o usuário está logado
        if (!isset($_SESSION['cliente'])) {
            echo "<script>alert('Você precisa estar logado para acessar as notificações.'); window.location.href = 'login.php';</script>";
            exit();
        }

        // Acessa os dados do usuário logado

        //$id_cliente = $cliente['id_cliente'];
        $id_usuario = $_SESSION['id_usuario'];
    ?>

    <div class="header">
        <div class="retangulo-azul">
        <a href="/aluguel-de-carros/public/"><div class="home">Home</div></a>
            <a href="/aluguel-de-carros/public/car/index"><div class="nossos-veiculos">Nossos veículos</div></a>
            <a href="/aluguel-de-carros/public/user/showProfile"><div class="sobre-nos">Perfil</div></a>
        </div>
    </div>

    <h1>Suas Notificações</h1>

    <input type="hidden" id="clientId" value="<?= htmlspecialchars((string)$id_usuario, ENT_QUOTES, 'UTF-8'); ?>">



    <div id="notifications">
    <h3>Suas Notificações</h3>
    <?php if (!isset($_SESSION['notificacao'])): ?>
    <p>Erro: Sessão de notificações não está configurada.</p>
<?php elseif (empty($_SESSION['notificacao'])): ?>
    <p>Sem notificações encontradas para você.</p>
<?php else: ?>
    <?php foreach ($_SESSION['notificacao'] as $notificacao): ?>
        <div class="notification-item">
            <p><strong>Mensagem:</strong> <?= htmlspecialchars($notificacao['texto_mensagem'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Data:</strong> <?= htmlspecialchars(date("d/m/Y H:i", strtotime($notificacao['data_envio'])), ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</div>

</body>
</html>

