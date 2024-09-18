
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
    max-width: 400px;
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
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #218838;
}
</style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Veículo</h2>
        <form action="AdicionarVeiculo.php" method="POST" id="carForm">
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>
            </div> 
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" required  >
            </div>
            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" min="1900" max="2024" required>
            </div>
            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" required placeholder="AAA-0000" required pattern="[A-Z]{3}-\d{4}">
            </div>
            <div class="form-group">
                <label for="valorDiaria">Valor da Diária (R$):</label>
                <input type="number" id="valorDiaria" name="valorDiaria" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="1">Disponível</option>
                    <option value="2">Indisponível</option>
                    <option value="3">Em Manutenção</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar Veículo</button>
            </div>
            


        </form>
    </div>

    
</body>
</html>
