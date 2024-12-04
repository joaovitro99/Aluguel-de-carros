<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Veículos</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="stylesheet" href="../../public/assets/css/veiculos.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>LoCar</h1>
        </div>
        <ul class="menu">
            <?php
            //session_start();

            // Verifica se o usuário está logado
            if (!isset($_SESSION['user'])) {
                header('Location: /aluguel-de-carros/public/login/index');
                exit();
            }
            
            // Acessa os dados do usuário logado
            $user = $_SESSION['user'];
            
            if($user['tipo_usuario'] === 'admin'){
           echo '<li><a href="/aluguel-de-carros/public/usuarios/index">Usuários</a></li>';
           echo '<li><a href="/aluguel-de-carros/public/car/listar" class="active">Veículos</a></li>';
           echo '<li><a href="/aluguel-de-carros/public/rendimento/index">Rendimento</a></li>';
           echo '<li><a href="/aluguel-de-carros/public/alugueis/index">Alugueis</a></li>';
            }
            else{
                echo '<li><a href="veiculos.php" class="active">Veículos</a></li>';
            }
            ?>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <input type="text" id="search-bar" class="search-bar" placeholder="Buscar...">
            <button class="btn-novo-item"><a href="/aluguel-de-carros/app/views/FormularioVeiculo.php">+ Novo Item</a></button>
        </div>

        <div class="content">
            <h2>Olá, seja Bem-Vindo!</h2>

            <!-- Tabela de Veículos -->
            <table class="vehicles-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Concessionária</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Placa</th>
                        <th>Preço diaria</th>
                        <th>Status</th>
                        <th>Capacidade Pessoas</th>
                        <th>Capacidade Bagageiro</th>
                        <th>Combustivel</th>
                        <th>Cambio</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($veiculos) {
                            while ($veiculo = $veiculos->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$veiculo['id_veiculo']}</td>";
                                echo "<td>{$veiculo['marca']}</td>";
                                echo "<td>{$veiculo['modelo']}</td>";
                                echo "<td>{$veiculo['ano']}</td>";
                                echo "<td>{$veiculo['placa']}</td>";
                                echo "<td>R$ {$veiculo['valor_diaria']}</td>";
                                echo "<td>{$veiculo['status']}</td>";
                                echo "<td>{$veiculo['capacidade_pessoas']}</td>";
                                echo "<td>{$veiculo['capacidade_bagageiro']}</td>";
                                echo "<td>{$veiculo['combustivel']}</td>";
                                echo "<td>{$veiculo['cambio']}</td>";
                                echo "<td>
                                        <a href='editor.php?id={$veiculo['id_veiculo']}' class='btn-edit'>Editar</a>
                                        <form class='delete-form' data-id='{$veiculo['id_veiculo']}' style='display:inline;'>
                                            <input type='hidden' name='id_veiculo' value='{$veiculo['id_veiculo']}'>
                                            <button type='submit' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>Nenhum veículo encontrado.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script defer>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('/aluguel-de-carros/public/car/delete', {
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

            fetch(`/aluguel-de-carros/public/car/buscarAdmin?term=${encodeURIComponent(searchTerm)}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('.vehicles-table tbody');
                tbody.innerHTML = ''; // Limpa a tabela

                if (data.length > 0) {
                    data.forEach(veiculo => {
                        const row = `
                            <tr>
                                <td>${veiculo.id_veiculo}</td>
                                <td>${veiculo.marca}</td>
                                <td>${veiculo.modelo}</td>
                                <td>${veiculo.ano}</td>
                                <td>${veiculo.placa}</td>
                                <td>R$ ${veiculo.valor_diaria}</td>
                                <td>${veiculo.status}</td>
                                <td>${veiculo.capacidade_pessoas}</td>
                                <td>${veiculo.capacidade_bagageiro}</td>
                                <td>${veiculo.combustivel}</td>
                                <td>${veiculo.cambio}</td>
                                <td>
                                    <a href='editor.php?id=${veiculo.id_veiculo}' class='btn-edit'>Editar</a>
                                    <form class='delete-form' data-id='${veiculo.id_veiculo}' style='display:inline;'>
                                        <input type='hidden' name='id_veiculo' value='${veiculo.id_veiculo}'>
                                        <button type='submit' class='btn-delete' onclick='return confirm("Tem certeza que deseja excluir?")'>Excluir</button>
                                    </form>
                                </td>
                            </tr>`;
                        tbody.innerHTML += row;
                    });
                } else {
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
