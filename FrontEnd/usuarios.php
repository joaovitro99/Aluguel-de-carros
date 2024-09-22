<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração - Alucarros</title>
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
               
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
