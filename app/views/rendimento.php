
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de alugueis</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="stylesheet" href="../../public/assets/css/rendimento.css">

    
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>LoCar</h1>
        </div>
        <ul class="menu">
            <li><a href="/aluguel-de-carros/public/usuarios/index">Usuários</a></li>
            <li><a href="/aluguel-de-carros/public/car/listar">Veículos</a></li>
            <li><a href="rendimento.php" class="active">Rendimento</a></li>
            <li><a href="/aluguel-de-carros/public/alugueis/index">Alugueis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="search-bar-container"></div>

        <div class="content">
            <div class="content-header">
                <h2>Visualização de aluguéis</h2>
                <form method="GET" class="filter-form">
                    <label for="intervalo">Filtrar por:</label>
                    <div class="styled-select">
                        <select name="intervalo" id="intervalo" onchange="this.form.submit()">
                            <option value="">Selecionar</option>
                            <option value="1">Último mês</option>
                            <option value="3">Últimos 3 meses</option>
                            <option value="6">Últimos 6 meses</option>
                            <option value="12">Último ano</option>
                            <option value="tudo">Todos os períodos</option>
                        </select>
                    </div>
                </form>
            </div>

            <table class="sales-table">
                <thead>
                    <tr>
                        <th>Informações do veículo</th>
                        <th>Quantidade de aluguéis</th>
                        <th>Valor da diária</th>
                        <th>Valor total por veículo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rendimentos as $rendimento): ?>
                        <tr>
                            <td>
                                <div class="vehicle-info">
                                    <?php if (!empty($rendimento['imagem'])): ?>
                                        <img 
                                            src="data:image/jpeg;base64,<?= base64_encode($rendimento['imagem']) ?>" 
                                            alt="Veículo" 
                                            class="vehicle-image"
                                        >
                                    <?php else: ?>
                                        <img 
                                            src="/aluguel-de-carros/public/assets/img/no-image.png" 
                                            alt="Imagem não disponível" 
                                            class="vehicle-image"
                                        >
                                    <?php endif; ?>
                                    <div>
                                        <p><?= $rendimento['marca'] ?></p>
                                        <p><?= $rendimento['modelo'] ?></p>
                                        <p><?= $rendimento['combustivel'] ?></p>
                                        <p><?= $rendimento['cambio'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td><?= $rendimento['quantidade'] ?></td>
                            <td>R$<?= number_format($rendimento['valor_diaria'], 2, ',', '.') ?></td>
                            <td>R$<?= number_format($rendimento['total_por_carro'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

</body>
</html>