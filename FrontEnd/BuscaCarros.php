<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styleCarros.css">
</head>

<body>
    <div class="desktop">
        <div class="header">
            <div class="logo">Logo</div>
            <div class="nav-buttons">
                <a href="pagina_inicial.php">Home</a>
                <a href="#vehicles">Nossos veículos</a>
                <a href="pagina_inicial.php">Sobre nós</a>
            </div>
            <div class="auth-buttons">
                <a href="Cadastro.php" class="button">Inscrever-se</a>
                <div class="separator"></div>
                <a href="Login.php" class="button">Entrar</a>
            </div>
        </div>
        <div class="overlap-wrapper">
            <div class="overlap">
                <div class="overlap-group">
                    <input type="text" class="input-field-local" placeholder="Local de retirada">
                </div>

                <!-- Campos de Data e Hora de Retirada -->
                <div class="div">
                    <div class="input-group">
                        <input type="text" id="date-picker" class="input-field left" placeholder="Data de retirada">
                        <input type="text" id="time-picker" class="input-field right" placeholder="Hora de retirada">
                    </div>
                </div>

                <!-- Campos de Data e Hora de Devolução -->
                <div class="overlap-2">
                    <div class="input-group">
                        <input type="text" id="date-return" class="input-field left" placeholder="Data de devolução">
                        <input type="text" id="time-return" class="input-field right" placeholder="Hora de devolução">
                    </div>
                </div>

                <!-- Botão Continuar -->
                <div class="div-wrapper">
                    <button class="continue-button">Continuar</button>
                </div>
            </div>
        </div>
        <div class="filter-container">
            <div class="group-selection">Escolha o grupo de carros que melhor te atende</div>
                <div class="filter-header" id="filter-header">
                    <h2>Filtros de busca</h2>
                    <div class="toggle-icon" id="toggle-icon">
                        <img src="assets/images/icons/arrow-icon.svg" alt="Toggle Icon">
                    </div>
                </div>
                <form method="POST" id="filter-form">
                    <div class="filter-panel" id="filter-panel">
                        <div class="filter-group-labels">
                            <div class="filter-label1">Tipo de Concessionária:</div>
                            <div class="filter-label2">Bagageiro:</div>
                            <div class="filter-label3">Preço:</div>
                        </div> 
                        <div class="filter-group-container">
                            <div class="filter-group">
                                <div class="filter-options">
                                    <label>
                                        <input type="checkbox" name="concessionarias[]" value="Honda" class="filter-checkbox"> Honda
                                    </label>
                                    <label>
                                        <input type="checkbox" name="concessionarias[]" value="Toyota" class="filter-checkbox"> Toyota
                                    </label>
                                    <label>
                                        <input type="checkbox" name="concessionarias[]" value="Ford" class="filter-checkbox"> Ford
                                    </label>
                                    <label>
                                        <input type="checkbox" name="concessionarias[]" value="Chevrolet" class="filter-checkbox"> Chevrolet
                                    </label>
                                    <label>
                                        <input type="checkbox" name="concessionarias[]" value="Volkswagen" class="filter-checkbox"> Volkswagen
                                    </label>
                                    <label>
                                        <input type="checkbox" name="concessionarias[]" value="Hyundai" class="filter-checkbox"> Hyundai
                                    </label>
                                </div>
                            </div>
                            <div class="filter-group">
                                <select name="num_malas">
                                    <option value="">Número de malas</option>
                                    <option value="1-2">1 a 2 malas</option>
                                    <option value="3-4">3 a 4 malas</option>
                                    <option value="5-6">5 a 6 malas</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <div class="price-filter">
                                    <input type="text" name="min_price" class="input-price" placeholder="Mínimo" />
                                    <span>-</span>
                                    <input type="text" name="max_price" class="input-price" placeholder="Máximo" />
                                </div>
                                <button type="submit" class="filter-button">FILTRAR</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <script src="assets/js/script.js"></script>
            <div id="grid">
            <?php
                include("../BackEnd/data/mySqlDataProvider.php"); // Certifique-se que o caminho está correto
                include("../BackEnd/repositories/CarRepository.php");
                include("../BackEnd/app/config.php");

                // Chama a função para obter a conexão com o banco de dados
                $conn = new MySqlDataProvider($config);

                // Inicializa os filtros
                $concessionarias = isset($_POST['concessionarias']) ? $_POST['concessionarias'] : [];
                $num_malas = isset($_POST['num_malas']) ? $_POST['num_malas'] : '';
                $min_price = isset($_POST['min_price']) ? $_POST['min_price'] : '';
                $max_price = isset($_POST['max_price']) ? $_POST['max_price'] : '';

                // Cria um array para armazenar as condições da consulta
                $conditions = [];
                if (!empty($concessionarias)) {
                    $concessionariasList = "'" . implode("', '", $concessionarias) . "'";
                    $conditions[] = "v.marca IN ($concessionariasList)";
                }
                // Lógica para lidar com o número de malas
                if (!empty($num_malas)) {
                    // Separar o intervalo em dois valores
                    list($min_malas, $max_malas) = explode('-', $num_malas);
                    $litros_por_mala = 70; // Cada mala ocupa 70 litros
                    $capacidade_necessaria_min = $min_malas * $litros_por_mala;
                    $capacidade_necessaria_max = $max_malas * $litros_por_mala;

                    // Adiciona as condições ao array
                    $conditions[] = "v.capacidade_bagageiro BETWEEN $capacidade_necessaria_min AND $capacidade_necessaria_max";
                }

                if (!empty($min_price)) {
                    $conditions[] = "v.valor_diaria >= $min_price";
                }
                if (!empty($max_price)) {
                    $conditions[] = "v.valor_diaria <= $max_price";
                }

                // Monta a consulta SQL
                $sql = "SELECT v.marca, v.modelo, v.ano, v.valor_diaria, i.imagem 
                        FROM veiculos v 
                        LEFT JOIN imagens_veiculo i ON v.id_veiculo = i.id_veiculo";

                if (!empty($conditions)) {
                    $sql .= " WHERE " . implode(" AND ", $conditions);
                }

                // Preparação e execução da consulta
                $stmt = $conn->query($sql);

                if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                        echo '<div id="car-card">';
                        if ($row['imagem']) { // Verifica se a imagem existe
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagem']) . '" alt="Imagem do Veículo">';
                        }
                        echo '<h3>Marca: ' . $row['marca'] . "</h3>";
                        echo '<p>Modelo: ' . $row['modelo'] . "</p>";
                        echo '<p>Ano: ' . $row['ano'] . "</p>";
                        echo '<p>Diária: R$ ' . $row['valor_diaria'] . "</p>";
                        echo '<button class="btn-alugar">Alugar</button>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Nenhum veículo encontrado.</p>";
                }
                ?>

            </div>
        </div>
    </div>
</body>
</html>
