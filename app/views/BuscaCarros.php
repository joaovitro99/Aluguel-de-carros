<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de Carros</title>
    <link rel="stylesheet" href="../../public/assets/css/styleCarros.css">
</head>

<body>
    <div class="desktop">
        <div class="header">
            <div class="logo">Logo</div>
            <div class="nav-buttons">
                <a href="/aluguel-de-carros/public/">Home</a>
                <a href="#vehicles" onclick="return false;">Nossos veículos</a>
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

                <div class="div">
                    <div class="input-group">
                        <input type="text" id="date-picker" class="input-field left" placeholder="Data de retirada">
                        <input type="text" id="time-picker" class="input-field right" placeholder="Hora de retirada">
                    </div>
                </div>

                <div class="overlap-2">
                    <div class="input-group">
                        <input type="text" id="date-return" class="input-field left" placeholder="Data de devolução">
                        <input type="text" id="time-return" class="input-field right" placeholder="Hora de devolução">
                    </div>
                </div>

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
                    <img src="../../public/assets/images/icons/arrow-icon.svg" alt="Toggle Icon">
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

        <div id="grid">
            <?php if (!empty($cars)): ?>
                <?php foreach ($cars as $car): ?>
                    <div id="car-card">
                        <?php if ($car['imagem']): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($car['imagem']) ?>" alt="Imagem do Veículo">
                        <?php endif; ?>
                        <h3>Marca: <?= $car['marca'] ?></h3>
                        <p>Modelo: <?= $car['modelo'] ?></p>
                        <p>Ano: <?= $car['ano'] ?></p>
                        <p>Diária: R$ <?= $car['valor_diaria'] ?></p>
                        <button class="btn-alugar">Alugar</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum veículo encontrado.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="../../public/assets/js/script.js"></script>
</body>
</html>
