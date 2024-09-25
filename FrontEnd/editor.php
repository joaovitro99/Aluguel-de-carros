<?php
// Inclui a classe de conexão e o arquivo de configuração
include("MySqlDataProvider.php");
include("config.php");

// Instancia a conexão com o banco de dados
$conn = new MySqlDataProvider($config);
$id_veiculo = 1;
// Verifica se o id_veiculo foi passado via GET para buscar os dados
if ($id_veiculo != 0) {

    // Consulta SQL para obter os dados do veículo
    $sql = "SELECT marca, modelo, ano, placa, status, valor_diaria, cambio, capacidade_bagageiro, capacidade_pessoas, combustivel FROM veiculos WHERE id_veiculo = ?";
    $sql2 = "SELECT imagem FROM imagens_veiculo WHERE id_veiculo = ?";
    $stmt = $conn->prepare(query: $sql);
    $stmt2 = $conn->prepare(query: $sql2);
    $stmt->bind_param("i", $id_veiculo);  // Vincula o parâmetro id_veiculo
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt2->bind_param("i", $id_veiculo);  // Vincula o parâmetro id_veiculo
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    // Verifica se o veículo foi encontrado
    if ($result->num_rows > 0) {
        $veiculo = $result->fetch_assoc();
    } else {
        echo "Veículo não encontrado.";
        exit;
    }
    
    $stmt->close();
} else {
    echo "ID de veículo não especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="editor.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Alucarros</h1>
        </div>
        <ul class="menu">
            <li><a href="usuarios.php">Usuários</a></li>
            <li><a href="veiculos.php"class="active">Veículos</a></li>
            <li><a href="rendimento.php">Rendimento</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <input type="text" class="search-bar" placeholder="Buscar...">
            <button class="btn-novo-item">+ Novo Item</button>
        </div>
        <div class="content">
        <h2>Olá, admin!</h2>
        <form action="atualizar_dados.php" method="post" enctype="multipart/form-data">
   
            <div class="imagem-veiculo">
                <?php
                    $row = $result2->fetch_assoc();
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagem']) . '" alt="Imagem do Veículo">';
                ?>
            </div> 
            <input type="hidden" name="id_veiculo" value="<?php echo $id_veiculo; ?>">

            <div class="form-group">
                <label for="marca"><strong>Marca:</strong></label>
                <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($veiculo['marca']); ?>" required>
            </div>

            <div class="form-group">
                <label for="modelo"><strong>Modelo:</strong></label>
                <input type="text" id="modelo" name="modelo" value="<?php echo htmlspecialchars($veiculo['modelo']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ano"><strong>Ano:</strong></label>
                <input type="text" id="ano" name="ano" value="<?php echo htmlspecialchars($veiculo['ano']); ?>" required>
            </div>

            <div class="form-group">
                <label for="placa"><strong>Placa:</strong></label>
                <input type="text" id="placa" name="placa" value="<?php echo htmlspecialchars($veiculo['placa']); ?>" required>
            </div>

            <div class="form-group">
                <label for="status"><strong>Status:</strong></label>
                <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($veiculo['status']); ?>" required>
            </div>

            <div class="form-group">
                <label for="valor_diaria"><strong>Valor Diária:</strong></label>
                <input type="text" id="valor_diaria" name="valor_diaria" value="<?php echo htmlspecialchars($veiculo['valor_diaria']); ?>" required>
            </div>

            <div class="form-group">
                <label for="cambio"><strong>Câmbio:</strong></label>
                <input type="text" id="cambio" name="cambio" value="<?php echo htmlspecialchars($veiculo['cambio']); ?>" required>
            </div>

            <div class="form-group">
                <label for="capacidade_bagageiro"><strong>Capacidade do Bagageiro (em Litros):</strong></label>
                <input type="text" id="capacidade_bagageiro" name="capacidade_bagageiro" value="<?php echo htmlspecialchars($veiculo['capacidade_bagageiro']); ?>" required>
            </div>

            <div class="form-group">
                <label for="capacidade_pessoas"><strong>Capacidade de Pessoas:</strong></label>
                <input type="text" id="capacidade_pessoas" name="capacidade_pessoas" value="<?php echo htmlspecialchars($veiculo['capacidade_pessoas']); ?>" required>
            </div>

            <div class="form-group">
                <label for="combustivel"><strong>Combustível:</strong></label>
                <input type="text" id="combustivel" name="combustivel" value="<?php echo htmlspecialchars($veiculo['combustivel']); ?>" required>
            </div>

            <div class="form-group">
                <label for="imagem_veiculo"><strong>Alterar Imagem:</strong></label>
                <input type="file" name="imagem_veiculo" id="imagem_veiculo" accept="image/*">
            </div>
        
        
        <button type="submit">Salvar</button>
    </form>

    <a href="veiculos.php">Voltar</a> <!-- Link para voltar à lista de veículos -->
</body>
</html>


               