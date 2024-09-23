
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Vendas</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/rendimento.css">

    
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Alucarros</h1>
        </div>
        <ul class="menu">
            <li><a href="usuarios.php">Usuários</a></li>
            <li><a href="veiculos.php">Veículos</a></li>
            <li><a href="rendimento.php" class="active">Rendimento</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="search-bar-container">
            <input type="text" class="search-bar" placeholder="Buscar...">
        </div>

        <div class="content">
            <h2>Visualização de Vendas</h2>
            <table class="sales-table">
                <thead>
                    <tr>
                        <th>Informações do veículo</th>
                        <th>Vendas</th>
                        <th>Região</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="vehicle-info">
                                <img src="path/to/image1.jpg" alt="Veículo 1" class="vehicle-image">
                                <div>
                                    <p>Nome do Veículo</p>
                                    <p>Modelo</p>
                                    <p>Combustível</p>
                                    <p>Câmbio</p>
                                </div>
                            </div>
                        </td>
                        <td>10</td>
                        <td>Região 1</td>
                        <td>R$0,00</td>
                    </tr>
                    <!-- Adicionar mais linhas conforme necessário -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

</body>
</html>