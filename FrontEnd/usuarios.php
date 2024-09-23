<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Alucarros</h1>
        </div>
        <ul class="menu">
            <li><a href="usuarios.php" class="active">Usuários</a></li>
            <li><a href="veiculos.php">Veículos</a></li>
            <li><a href="rendimento.php">Rendimento</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <input type="text" class="search-bar" placeholder="Buscar...">
            <button class="btn-novo-item">+ Novo Item</button>
        </div>

        <div class="content">
            <h2>Olá, admin!</h2>

            <!-- Tabela de Usuários -->
            <table class="users-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody id="users-body">
                    <?php
                    require_once '../BackEnd/data/mySqlDataProvider.php';
                    require_once '../BackEnd/app/config.php';

                    // Instancia a conexão
                    $db = new MySqlDataProvider($config);

                    // Consulta para buscar os usuários
                    $sql = "SELECT * FROM clientes";
                    $stmt = $db->prepare($sql);
                    
                    if ($stmt) {
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($usuario = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$usuario['id_cliente']}</td>";
                            echo "<td>{$usuario['nome']}</td>";
                            echo "<td>{$usuario['cpf']}</td>";
                            echo "<td>{$usuario['endereco']}</td>";
                            echo "<td>{$usuario['telefone']}</td>";
                            echo "<td>{$usuario['email']}</td>";
                            echo "<td>
                                    <a href='editusuario.php?id={$usuario['id_cliente']}' class='btn-edit'>Editar</a>
                                    <form class='delete-form' data-id='{$usuario['id_cliente']}' style='display:inline;' method='POST'>
                                        <input type='hidden' name='id_cliente' value='{$usuario['id_cliente']}'>
                                        <button type='submit' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                        $stmt->close();
                    } else {
                        echo "Erro ao preparar a consulta ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('../BackEnd/admin/DeleteUsuario.php', {
                    method: 'POST',
                    body: formData
                })
                .then(() => {
                    // Remove a linha da tabela
                    this.closest('tr').remove();
                })
                .catch(error => {
                    console.error('Erro ao processar a solicitação:', error);
                });
            });
        });
    </script>
</body>
</html>
