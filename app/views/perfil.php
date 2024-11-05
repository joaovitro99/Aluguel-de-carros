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
            <a href="/aluguel-de-carros/public/car/index"><div class="nossos-veiculos">Nossos veículos</div></a>
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
           
                <h3>Marca:</h3>
                <p>Modelo: </p>
                <p>Ano: </p>
                <p>Data de Início: </p>
                <p>Data de Fim: </p>
                <p>Valor Total: R$ </p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum histórico de aluguéis encontrado.</p>
    <?php endif; ?>
</div>

    </div>
</body>
</html>
