<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Locações</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Alucarros</h1>
        </div>
        <ul class="menu">
            <li><a href="/aluguel-de-carros/public/usuarios/index">Usuários</a></li>
            <li><a href="/aluguel-de-carros/public/car/listar">Veículos</a></li>
            <li><a href="/aluguel-de-carros/public/rendimento/index">Rendimento</a></li>
            <li><a href="/aluguel-de-carros/public/alugueis/index" class="active">Alugueis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <input type="text" class="search-bar" placeholder="Buscar...">
            <button class="btn-novo-item">+ Novo Item</button>
        </div>

        <div class="content">
            <div class="content-header">
                <h2>Olá, admin!</h2>
                <a href="/aluguel-de-carros/public/notificacao/enviarManual" class="btn-enviar-email">
                    Enviar Email
                    <img src="/aluguel-de-carros/public/assets/images/icons/imagemdoemail.png" alt="Ícone de email" class="email-icon">
                </a>
            </div>

            <table class="rental-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Veículo</th>
                    <th>Data de Início</th>
                    <th>Data de Fim</th>
                    <th>Valor Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="rentalTableBody">
                <?php if (!empty($alugueis)): ?>
                    <?php foreach ($alugueis as $aluguel): ?>
                        <tr id="rental-<?= htmlspecialchars($aluguel->getId(), ENT_QUOTES, 'UTF-8'); ?>">
                            <td><?= htmlspecialchars($aluguel->getId(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($aluguel->getIdCliente(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($aluguel->getIdVeiculo(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($aluguel->getDataInicio(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($aluguel->getDataFim(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>R$ <?= number_format($aluguel->getValorTotal(), 2, ',', '.'); ?></td>
                            <td>
                                <button onclick="deleteRental(<?= htmlspecialchars($aluguel->getId(), ENT_QUOTES, 'UTF-8'); ?>)"class='btn-delete'>Excluir</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Nenhum aluguel encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</body>
</html>

<script>

    // Função para excluir um aluguel
    function deleteRental(id) {
        if (confirm('Deseja excluir este aluguel?')) {
            fetch(`/aluguel-de-carros/public/api/alugueis/${id}`, {
                method: 'DELETE',
            })
            .then(response => {
                if (response.ok) {
                    alert('Aluguel excluído com sucesso!');
                    // Remove a linha da tabela
                    document.querySelector(`#rentalTableBody tr td:first-child:contains(${id})`).parentElement.remove();
                } else {
                    alert('Erro ao excluir aluguel');
                }
            })
            .catch(error => {
                console.error('Erro ao excluir aluguel:', error);
            });
        }
    }

    // Carregar os aluguéis assim que a página for carregada
    document.addEventListener('DOMContentLoaded', loadRentals);
</script>
