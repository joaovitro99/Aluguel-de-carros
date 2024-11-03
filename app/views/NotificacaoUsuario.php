<!-- views/notifications.html -->
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
    
    color: white; /* Cor do texto do cabeçalho */
    padding: 20px; /* Espaçamento interno */
    text-align: center; /* Centralizar texto */
    height: 20vh;
    
}

.container {
    padding: 20px; /* Espaçamento interno da página */
    display: flex;
    flex-direction: column; /* Alinhar os elementos em colunas */
    align-items: center; /* Centralizar elementos horizontalmente */
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
            padding: 10px 0;
            background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        }
        .notification-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="retangulo-azul">
            <a href="pagina_inicial.php"><div class="home">Home</div></a>
            <a href="BuscaCarros.php"><div class="nossos-veiculos">Nossos veículos</div></a>
            <a href="pagina_inicial.php"><div class="sobre-nos">Sobre-nós</div></a>
            <a href="perfil.php"><div class="sobre-nos">Perfil</div></a>
        </div>
    </div>

    <h1>Notificações
    <?php
            session_start();

            // Verifica se o usuário está logado
            if (!isset($_SESSION['user'])) {
                echo "<script>
                alert('erro nas notificacoes');
              </script>";
                exit();
            }
            
            // Acessa os dados do usuário logado
            $user = $_SESSION['user'];
            ?>
    </h1>

    <input type="hidden" id="clientId" value="<?= htmlspecialchars($user['id']); ?>">

    <script>
        async function fetchNotifications() {
            const clientId = document.getElementById('clientId').value;
            if (!clientId) {
                alert("erro no ID do cliente");
                return;
            }

            try {
                const response = await fetch(`../index.php?client_id=${clientId}`);
                const data = await response.json();

                const notificationsContainer = document.getElementById('notifications');
                notificationsContainer.innerHTML = '<h3>Suas Notificações</h3>';

                if (data.length > 0) {
                    data.forEach(notification => {
                        const item = document.createElement('div');
                        item.classList.add('notification-item');
                        item.innerHTML = `
                            <p><strong>Mensagem:</strong> ${notification.message}</p>
                            <p><strong>Data:</strong> ${new Date(notification.sent_at).toLocaleString()}</p>
                        `;
                        notificationsContainer.appendChild(item);
                    });
                } else {
                    notificationsContainer.innerHTML = '<p>Sem notificações encontradas para voce.</p>';
                }
            } catch (error) {
                console.error("Erro ao buscar notificações:", error);
                alert("Erro ao buscar notificações.");
            }
        }
    </script>

</body>
</html>
