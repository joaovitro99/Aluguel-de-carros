<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="desktop">
        <div class="header">
            <div class="logo">Logo</div>
            <div class="nav-buttons">
                <a href="#home">Home</a>
                <a href="#vehicles">Nossos veículos</a>
                <a href="#about">Sobre nós</a>
            </div>
            <div class="auth-buttons">
                <a href="#signup" class="button">Inscrever-se</a>
                <div class="separator"></div>
                <a href="#login" class="button">Entrar</a>
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
            <!-- Novo texto adicionado -->
            <div class="group-selection">Escolha o grupo de carros que melhor te atende</div>
            <div class="filter-header" id="filter-header">
                <h2>Filtros de busca</h2>
                <div class="toggle-icon" id="toggle-icon">
                    <img src="images/icons/arrow-icon.svg" alt="Toggle Icon">
                </div>
            </div>
            <div class="filter-panel" id="filter-panel">
            <div class="filter-group-container">
                <div class="filter-group">
                    <div class="filter-label">Tipo de Veículo:</div>
                    <div class="filter-options">
                        <label>
                            <input type="checkbox" class="filter-checkbox">
                            Sedan
                        </label>
                        <label>
                            <input type="checkbox" class="filter-checkbox">
                            Hatch
                        </label>
                        <label>
                            <input type="checkbox" class="filter-checkbox">
                            Minivan
                        </label>
                        <label>
                            <input type="checkbox" class="filter-checkbox">
                            SUV
                        </label>
                        <label>
                            <input type="checkbox" class="filter-checkbox">
                            Picapes
                        </label>
                        <label>
                            <input type="checkbox" class="filter-checkbox">
                            Esportivo
                        </label>
                    </div>
                </div>
                <div class="filter-group">
                    <div class="filter-label">Bagageiro:</div>
                    <select>
                        <option value="">Número de malas</option>
                        <option value="1">1 mala</option>
                        <option value="2">2 malas</option>
                        <option value="3">3 malas</option>
                        <option value="4">4 malas</option>
                        <option value="5">5 malas</option>
                    </select>
                    <button class="filter-button">FILTRAR</button>
                </div>
            </div>
        </div>   
    </div>
    <script src="script.js"></script>
</body>
</html>