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
            <a href="/aluguel-de-carros/public/"><div class="home">Home</div></a>
            <a href="/aluguel-de-carros/public/car/index"><div class="nossos-veiculos">Nossos veículos</div></a>
            <a href="pagina_inicial.php"><div class="sobre-nos">Sobre-nós</div></a>

            <a href="/aluguel-de-carros/public/notificacao/indexnotificacoes">
            <div class="notification-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.7-14.9A1 1 0 0 0 7 1a1 1 0 0 0-.7.1A4.992 4.992 0 0 0 3 5c0 1.098-.232 2.413-.44 3.287a3.004 3.004 0 0 1-.95 1.592l-.491.491A1 1 0 0 0 2.22 12h11.56a1 1 0 0 0 .787-1.63l-.492-.492a3.004 3.004 0 0 1-.95-1.592C13.233 7.413 13 6.098 13 5a4.992 4.992 0 0 0-2.3-3.9zM1 12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1h-2.964a3 3 0 0 1-5.072 0H1z"/>
                </svg>
            </div>
            </a>

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
        <h2>Nome: <?= $_SESSION['cliente']['nome'] ?? 'Não disponível' ?></h2>
        <h2>Email: <?= $_SESSION['cliente']['email'] ?? 'Não disponível' ?></h2>
        <h2>Telefone: <?= $_SESSION['cliente']['telefone'] ?? 'Não disponível' ?></h2>
    </div>

        <div id="titulo_hist">Histórico de Aluguéis</div>
        <div id="dashboard_alugueis">
        <?php if (isset($_SESSION['rentals'])): ?>
    <?php foreach ($_SESSION['rentals'] as $rental): ?>
        <div class="rental-card">
            <h3>Marca: <?= $rental['marca'] ?? 'Não disponível' ?></h3>
            <p>Modelo: <?= $rental['modelo'] ?? 'Não disponível' ?></p>
            <p>Ano: <?= $rental['ano'] ?? 'Não disponível' ?></p>
            <p>Data de Início: <?= $rental['data_inicio'] ?? 'Não disponível' ?></p>
            <p>Data de Fim: <?= $rental['data_fim']  ?></p>
            <p>Valor Total: R$ <?= $rental['valor_total'] ?? 'Não disponível' ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhum aluguel encontrado.</p>
<?php endif; ?>
</div>

    </div>
</body>
</html>
