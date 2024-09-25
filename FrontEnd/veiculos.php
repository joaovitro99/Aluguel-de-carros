<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Veículos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/veiculos.css">


</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Alucarros</h1>
        </div>
        <ul class="menu">
            <li><a href="usuarios.php">Usuários</a></li>
            <li><a href="veiculos.php" class="active">Veículos</a></li>
            <li><a href="rendimento.php">Rendimento</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
        <input type="text" class="search-bar" placeholder="Buscar...">
        <button class="btn-novo-item"><a href="../BackEnd/admin/FormularioVeiculo.php">+ Novo Item</a></button>
        </div>

        <div class="content">
            <h2>Olá, admin!</h2>

            <!-- Tabela de Veículos -->
            <table class="vehicles-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Concessionária</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Placa</th>
                        <th>Preço diaria</th>
                        <th>Disponível</th>
                        <th>Operações</th>
                        <th>Capacidade Pessoas</th>
                        <th>Capacidade Bagageiro</th>
                        <th>Combustivel</th>
                        <th>Cambio</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Linhas de exemplo -->
                    <!-- Mais linhas -->
                    <?php
                        include("../BackEnd/data/mySqlDataProvider.php"); // Certifique-se que o caminho está correto
                        include("../BackEnd/repositories/CarRepository.php");
                        include("../BackEnd/app/config.php");

                        // Chama a função para obter a conexão com o banco de dados
                        $db = new MySqlDataProvider($config);

                        // Consulta para buscar os veículos
                        $sql = "SELECT * FROM veiculos";
                        $stmt = $db->prepare($sql);
                        
                        if ($stmt) {
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($veiculo = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$veiculo['id_veiculo']}</td>";
                                echo "<td>{$veiculo['marca']}</td>";
                                echo "<td>{$veiculo['modelo']}</td>";
                                echo "<td>{$veiculo['ano']}</td>";
                                echo "<td>{$veiculo['placa']}</td>";
                                echo "<td>R$ {$veiculo['valor_diaria']}</td>";
                                echo "<td>{$veiculo['status']}</td>";
                                echo "<td>" . $veiculo['capacidade_pessoas'] . "</td>";
                                echo "<td>" . $veiculo['capacidade_bagageiro'] . "</td>";
                                echo "<td>" . $veiculo['combustivel'] . "</td>";
                                echo "<td>" . $veiculo['cambio'] . "</td>";
                                echo "<td>
                                        <a href='editor.php?id={$veiculo['id_veiculo']}' class='btn-edit'>Editar</a>
                                        <form class='delete-form' data-id='{$veiculo['id_veiculo']}' style='display:inline;'>
                                            <input type='hidden' name='id_veiculo' value='{$veiculo['id_veiculo']}'>
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
                fetch('../BackEnd/admin/DeleteVeiculo.php', {
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