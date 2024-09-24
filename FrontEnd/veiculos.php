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
                        $conn = new MySqlDataProvider($config);

                        // Consulta SQL para obter os dados dos clientes
                        $sql = "SELECT id_veiculo,marca, modelo, ano,placa,valor_diaria,status,capacidade_pessoas,capacidade_bagageiro,combustivel,cambio FROM veiculos ";

                        // Preparação e execução da consulta
                        $stmt = $conn->query($sql);

                        // Verificação se existem registros
                        if ($stmt->num_rows >0) {
                            // Loop pelos resultados da consulta e exibição na tabela
                            while ($row = $stmt->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id_veiculo'] . "</td>";
                                echo "<td>" . $row['marca'] . "</td>";
                                echo "<td>" . $row['modelo'] . "</td>";
                                echo "<td>" . $row['ano'] . "</td>";
                                echo "<td>" . $row['placa'] . "</td>";
                                echo "<td>" . $row['valor_diaria'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>" . $row['capacidade_pessoas'] . "</td>";
                                echo "<td>" . $row['capacidade_bagageiro'] . "</td>";
                                echo "<td>" . $row['combustivel'] . "</td>";
                                echo "<td>" . $row['cambio'] . "</td>";
                                echo "<td><button class='edit-btn'>Editar</button> <button class='delete-btn'>Excluir</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Nenhum cliente encontrado</td></tr>";
                        }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>