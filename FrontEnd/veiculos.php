


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
                        <th>Câmbio</th>
                        <th>Combustível</th>
                        <th>Preço</th>
                        <th>Disponível</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Linhas de exemplo -->
                    <tr>
                        <td>1</td>
                        <td>Fiat Uno</td>
                        <td>2004</td>
                        <td>Manual</td>
                        <td>Diesel</td>
                        <td>R$25.000,00</td>
                        <td>Sim</td>
                        <td>
                            <button class="btn-edit">Editar</button>
                            <button class="btn-delete">Excluir</button>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
