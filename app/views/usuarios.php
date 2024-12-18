<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>LoCar</h1>
        </div>
        <ul class="menu">
            <li><a href="/aluguel-de-carros/public/usuarios/index" class="active">Usuários</a></li>
            <li><a href="/aluguel-de-carros/public/car/listar">Veículos</a></li>
            <li><a href="/aluguel-de-carros/public/rendimento/index">Rendimento</a></li>
            <li><a href="/aluguel-de-carros/public/alugueis/index">Alugueis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <input type="text" id='search-bar' class="search-bar" placeholder="Buscar...">
            <button class="btn-novo-item"><a href="/aluguel-de-carros/app/views/FormularioFuncionario.php"> Adicionar Funcionario</a></button>
        </div>

        <div class="content">
            <div class="content-header">
                <h2>Olá, admin!</h2>
                <a href="/aluguel-de-carros/public/notificacao/enviarManual" class="btn-enviar-email">
                    Enviar Email
                    <img src="/aluguel-de-carros/public/assets/images/icons/imagemdoemail.png" alt="Ícone de email" class="email-icon">
                </a>
            </div>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario->id ?></td>
                            <td><?= $usuario->nome ?></td>
                            <td><?= $usuario->cpf ?></td>
                            <td><?= $usuario->endereco ?></td>
                            <td><?= $usuario->telefone ?></td>
                            <td><?= $usuario->email ?></td>
                            <td>
                                <a href="editusuario.php?id=<?= $usuario->id ?>" class="btn-edit">Editar</a>
                                <form class="delete-form" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_cliente" value="<?= $usuario->id ?>">
                                    <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('/aluguel-de-carros/public/user/delete', {
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


        document.getElementById('search-bar').addEventListener('input', debounce(function() {
            const searchTerm = this.value;

            fetch(`/aluguel-de-carros/public/user/buscarAdmin?term=${encodeURIComponent(searchTerm)}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('.users-table tbody');
                tbody.innerHTML = ''; // Limpa a tabela

                if (data.length > 0) {
                    data.forEach(usuario => {
                        const row = `
                            <tr>
                                <td>${usuario.id}</td>
                                <td>${usuario.nome}</td>
                                <td>${usuario.cpf}</td>
                                <td>${usuario.endereco}</td>
                                <td>${usuario.telefone}</td>
                                <td>${usuario.email}</td>
                                <td>
                                    <a href='editusuario.php?id=${usuario.id}' class='btn-edit'>Editar</a>
                                    <form class='delete-form' data-id='${usuario.id}' style='display:inline;'>
                                        <input type='hidden' name='id_cliente' value='${usuario.id}'>
                                        <button type='submit' class='btn-delete' onclick='return confirm("Tem certeza que deseja excluir?")'>Excluir</button>
                                    </form>
                                </td>
                            </tr>`;
                        tbody.innerHTML += row;
                    });
                }
             else {
                    tbody.innerHTML = "<tr><td colspan='12'>Nenhum veículo encontrado.</td></tr>";
                }
            })
            .catch(error => console.error('Erro ao buscar veículos:', error));
        }, 300));

        // Função debounce para evitar muitas requisições
        function debounce(func, delay) {
            let debounceTimer;
            return function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => func.apply(this, arguments), delay);
            };
        }

    </script>
</body>
</html>
