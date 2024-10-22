<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Veículos</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="stylesheet" href="../../public/assets/css/veiculos.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Alucarros</h1>
        </div>
        <ul class="menu">
            <?php
            //session_start();

            // Verifica se o usuário está logado
            if (!isset($_SESSION['user'])) {
                header('Location: Login.php');
                exit();
            }
            
            // Acessa os dados do usuário logado
            $user = $_SESSION['user'];
            
            if($user['tipo_usuario'] === 'admin'){
           echo '<li><a href="/aluguel-de-carros/public/usuarios/index">Usuários</a></li>';
           echo '<li><a href="/aluguel-de-carros/public/car/listar" class="active">Veículos</a></li>';
           echo '<li><a href="/aluguel-de-carros/public/rendimento/index">Rendimento</a></li>';
            }
            else{
                echo '<li><a href="veiculos.php" class="active">Veículos</a></li>';
            }
            ?>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <input type="text" class="search-bar" placeholder="Buscar...">
            <button class="btn-novo-item"><a href="/aluguel-de-carros/app/views/FormularioVeiculo.php">+ Novo Item</a></button>
        </div>

        <div class="content">
            <h2>Olá, seja Bem-Vindo!</h2>

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
                        <th>Status</th>
                        <th>Capacidade Pessoas</th>
                        <th>Capacidade Bagageiro</th>
                        <th>Combustivel</th>
                        <th>Cambio</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($veiculos) {
                            while ($veiculo = $veiculos->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$veiculo['id_veiculo']}</td>";
                                echo "<td>{$veiculo['marca']}</td>";
                                echo "<td>{$veiculo['modelo']}</td>";
                                echo "<td>{$veiculo['ano']}</td>";
                                echo "<td>{$veiculo['placa']}</td>";
                                echo "<td>R$ {$veiculo['valor_diaria']}</td>";
                                echo "<td>{$veiculo['status']}</td>";
                                echo "<td>{$veiculo['capacidade_pessoas']}</td>";
                                echo "<td>{$veiculo['capacidade_bagageiro']}</td>";
                                echo "<td>{$veiculo['combustivel']}</td>";
                                echo "<td>{$veiculo['cambio']}</td>";
                                echo "<td>
                                        <a href='editor.php?id={$veiculo['id_veiculo']}' class='btn-edit'>Editar</a>
                                        <form class='delete-form' data-id='{$veiculo['id_veiculo']}' style='display:inline;'>
                                            <input type='hidden' name='id_veiculo' value='{$veiculo['id_veiculo']}'>
                                            <button type='submit' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>Nenhum veículo encontrado.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script defer>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('/aluguel-de-carros/public/car/delete', {
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
