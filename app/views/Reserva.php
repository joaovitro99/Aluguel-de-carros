<?php

//if (!isset($_SESSION['user'])) {
//    header('Location: /aluguel-de-carros/public/login/index');
//    exit();
//}

$local = $_SESSION['local'] ?? '';
$data_retirada = $_SESSION['data_retirada'] ?? '';
$hora_retirada = $_SESSION['hora_retirada'] ?? '';
$data_devolucao = $_SESSION['data_devolucao'] ?? '';
$hora_devolucao = $_SESSION['hora_devolucao'] ?? '';

// Formatação das datas e horas
$dataRetiradaObj = new DateTime($data_retirada . ' ' . $hora_retirada);
$dataDevolucaoObj = new DateTime($data_devolucao . ' ' . $hora_devolucao);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo da Reserva</title>
    <link rel="stylesheet" href="../../public/assets/css/resumoReserva.css">
</head>
<body>
    <div class="resumo-container">
        <h1>Detalhes da Reserva</h1>
        <?php if (isset($carro)): ?>
            <section>
                <h2>Retirada</h2>
                <p>Data de retirada: <?= htmlspecialchars($dataRetiradaObj->format('d/m/Y')) ?></p>
                <p>Hora de retirada: <?= htmlspecialchars($dataRetiradaObj->format('H:i')) ?></p>
                <p>Local de retirada: <?= htmlspecialchars($local) ?></p>
            </section>

            <section>
                <h2>Devolução</h2>
                <p>Data de devolução: <?= htmlspecialchars($dataDevolucaoObj->format('d/m/Y')) ?></p>
                <p>Hora de devolução: <?= htmlspecialchars($dataDevolucaoObj->format('H:i')) ?></p>
                <p>Local de devolução: <?= htmlspecialchars($local) ?></p>
            </section>

            <p>Você tem 3h de tolerância para devolver o carro, contadas a partir do horário que o retirou, dentro do horário de atendimento da agência.</p>

            <section>
                <h2>Veículo</h2>
                <p>Modelo: <?= htmlspecialchars($carro['modelo']) ?> ou similar</p>
                <p>Diária Padrão: R$ <?= number_format($carro['valor_diaria'], 2, ',', '.') ?></p>
                <p>Capacidade de Pessoas: <?= htmlspecialchars($carro['capacidade_pessoas']) ?></p>
                <p>Quantidade de Malas: <?= floor($carro['capacidade_bagageiro'] / 70) ?></p>
                <p>Tipo de Câmbio: <?= htmlspecialchars($carro['cambio']) ?></p>
                <p>Tipo de Combustível: <?= htmlspecialchars($carro['combustivel']) ?></p>
            </section>


            <section>
                <h2>Diárias</h2>
                <p><?= $diasAlugados ?> x R$ <?= number_format($carro['valor_diaria'], 2, ',', '.') ?></p>
                <p>Incluso: Taxa de Aluguel (12,00%) - R$ <?= number_format($carro['valor_diaria'] * $diasAlugados * 0.12, 2, ',', '.') ?></p>
                <h3>Valor total previsto: R$ <?= number_format(($carro['valor_diaria'] * $diasAlugados * 1.12), 2, ',', '.') ?></h3>
            </section>

        <?php else: ?>
            <p>Carro não encontrado.</p>
        <?php endif; ?>

        <section class="section-botao">
            <form action="confirmarReserva.php" method="post">
                <button type="submit" class="btn-confirmar">Finalizar Reserva</button>
            </form>
        </section>

    </div>
</body>
</html>
