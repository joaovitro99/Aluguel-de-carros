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
            <tbody>
                <?php if (!empty($alugueis)): ?>
                    <?php foreach ($alugueis as $aluguel): ?>
                        <tr>
                            <td><?= $aluguel->getId() ?></td>
                            <td><?= $aluguel->getIdCliente() ?></td>
                            <td><?= $aluguel->getIdVeiculo() ?></td>
                            <td><?= $aluguel->getDataInicio() ?></td>
                            <td><?= $aluguel->getDataFim() ?></td>
                            <td>R$ <?= number_format($aluguel->getValorTotal(), 2, ',', '.') ?></td>
                            <td>
                                <a href="/aluguel-de-carros/public/aluguel/show/<?= $aluguel->getId() ?>" class="btn-view">Ver</a>
                                <a href="/aluguel-de-carros/public/aluguel/edit/<?= $aluguel->getId() ?>" class="btn-edit">Editar</a>
                                <form action="/aluguel-de-carros/public/aluguel/delete/<?= $aluguel->getId() ?>" method="POST" style="display:inline;">
                                    <button type="submit" class="btn-delete" onclick="return confirm('Deseja excluir este aluguel?')">Excluir</button>
                                </form>
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
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('/aluguel-de-carros/public/locacoes/delete', {
                    method: 'POST',
                    body: formData
                })
                .then(() => {
                    // Remove a linha da tabela
                    this.closest('tr').remove();
                })
                .catch(error => {
                    console.error('Erro ao processar a solicitação:', error);
                });
            });
        });
    </script>
</body>
</html>
