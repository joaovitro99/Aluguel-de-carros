<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração - Alucarros</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
        <div class="search-bar-container">
            <input type="text" class="search-bar" placeholder="Buscar...">
        </div>

        <div class="content">
            <h2>Olá, admin!</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        include '../includes/db_connect.php'; // Certifique-se que o caminho está correto

                        // Chama a função para obter a conexão com o banco de dados
                        $conn = getConnection();

                        // Consulta SQL para obter os dados dos clientes
                        $sql = "SELECT id_cliente, nome, endereco, telefone, email FROM clientes";

                        // Preparação e execução da consulta
                        $stmt = $conn->query($sql);

                        // Verificação se existem registros
                        if ($stmt->rowCount() > 0) {
                            // Loop pelos resultados da consulta e exibição na tabela
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row['id_cliente'] . "</td>";
                                echo "<td>" . $row['nome'] . "</td>";
                                echo "<td>" . $row['endereco'] . "</td>";
                                echo "<td>" . $row['telefone'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
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
