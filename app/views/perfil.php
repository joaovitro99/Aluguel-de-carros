<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../../public/assets/css/perfil.css">
</head>
<body>
    <div class="header">
        <div class="retangulo-azul">
            <a href="pagina_inicial.php"><div class="home">Home</div></a>
            <a href="BuscaCarros.php"><div class="nossos-veiculos">Nossos veículos</div></a>
            <a href="pagina_inicial.php"><div class="sobre-nos">Sobre-nós</div></a>
            <div class="retangulo-laranja">
            <form action="logout" method="post" style="margin: 0;">
    <button type="submit" style="background: none; border: none; color: white; font-size: 16px; cursor: pointer;">
        <strong>Deslogar</strong>
    </button>
</form>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="info_cliente">
            <h2>Nome: <?= $cliente['nome'] ?></h2>
            <h2>Email: <?= $cliente['email'] ?></h2>
            <h2>Telefone: <?= $cliente['telefone'] ?></h2>
        </div>

        <div id="titulo_hist">Histórico de Aluguéis</div>
        <div id="dashboard_alugueis">
    <?php if (!empty($rentalHistory)): ?>
        <?php foreach ($rentalHistory as $rental): ?>
            <div class="rental-card">
                <?php if ($rental['imagem']): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($rental['imagem']) ?>" alt="Imagem do Veículo">
                <?php endif; ?>
                <h3>Marca: <?= $rental['marca'] ?></h3>
                <p>Modelo: <?= $rental['modelo'] ?></p>
                <p>Ano: <?= $rental['ano'] ?></p>
                <p>Data de Início: <?= $rental['data_inicio'] ?></p>
                <p>Data de Fim: <?= $rental['data_fim'] ?></p>
                <p>Valor Total: R$ <?= $rental['valor_total'] ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum histórico de aluguéis encontrado.</p>
    <?php endif; ?>
</div>

    </div>
</body>
</html>
