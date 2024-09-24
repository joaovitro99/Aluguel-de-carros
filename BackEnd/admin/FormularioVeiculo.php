<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veículo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(26, 181, 213, 0.37);
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .form-group.half {
            flex: 1;
        }

        .brand-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .brand-section img {
            max-height: 60px;
        }

        .brand-section h1 {
            font-size: 24px;
            margin-left: 20px;
            color: #007bff;
        }

    </style>
</head>
<body>
    <div class="container">
        <!-- Seção da Marca e Logo -->
        <div class="brand-section">
            <img src="logo.png" alt="Logo da Marca">
            <h1>Nome da Marca</h1>
        </div>

        <h2>Cadastro de Veículo</h2>
        <form action="AdicionarVeiculo.php" method="POST" id="carForm">
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>
            </div> 
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" required>
            </div>
            <div class="form-row">
                <div class="form-group half">
                    <label for="ano">Ano:</label>
                    <input type="number" id="ano" name="ano" min="1900" max="2024" required>
                </div>
                <div class="form-group half">
                    <label for="placa">Placa:</label>
                    <input type="text" id="placa" name="placa" required placeholder="AAA-0000" required pattern="[A-Z]{3}-\d{4}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group half">
                    <label for="valorDiaria">Valor da Diária (R$):</label>
                    <input type="number" id="valorDiaria" name="valorDiaria" step="0.01" required>
                </div>
                <div class="form-group half">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="1">Disponível</option>
                        <option value="2">Indisponível</option>
                        <option value="3">Em Manutenção</option>
                    </select>
                </div>
            </div>

            <!-- Capacidade de Pessoas e Bagageiro -->
            <div class="form-row">
                <div class="form-group half">
                    <label for="capacidade_pessoas">Capacidade de Pessoas:</label>
                    <input type="number" id="capacidade_pessoas" name="capacidade_pessoas" min="1" required>
                </div>
                <div class="form-group half">
                    <label for="capacidade_bagageiro">Capacidade do Bagageiro (L):</label>
                    <input type="number" id="capacidade_bagageiro" name="capacidade_bagageiro" min="0" required>
                </div>
            </div>

            <!-- Câmbio e Combustível -->
            <div class="form-row">
                <div class="form-group half">
                    <label for="cambio">Câmbio:</label>
                    <select id="cambio" name="cambio" required>
                        <option value="Manual">Manual</option>
                        <option value="Automático">Automático</option>
                    </select>
                </div>
                <div class="form-group half">
                    <label for="combustivel">Combustível:</label>
                    <select id="combustivel" name="combustivel" required>
                        <option value="Gasolina">Gasolina</option>
                        <option value="Álcool">Álcool</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Elétrico">Elétrico</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <button type="submit">Cadastrar Veículo</button>
            </div>
            
        </form>
    </div>
</body>
</html>
