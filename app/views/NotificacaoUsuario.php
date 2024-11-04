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
        }
        .notification-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

    <h1>Notificações</h1>
    <label for="clientId">ID do Cliente:</label>
    <input type="number" id="clientId" placeholder="Digite o ID do Cliente" required>
    <button onclick="fetchNotifications()">Buscar Notificações</button>

    <div id="notifications"></div>

    <script>
        async function fetchNotifications() {
            const clientId = document.getElementById('clientId').value;
            if (!clientId) {
                alert("Por favor, insira um ID do Cliente.");
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
                    notificationsContainer.innerHTML = '<p>Sem notificações encontradas para este cliente.</p>';
                }
            } catch (error) {
                console.error("Erro ao buscar notificações:", error);
                alert("Erro ao buscar notificações.");
            }
        }
    </script>

</body>
</html>
