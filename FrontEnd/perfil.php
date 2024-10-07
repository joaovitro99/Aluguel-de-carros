<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/perfil.css">
</head>

<body>
    <div class="header">
    <div class="retangulo-azul">
        
        <div class="home">Home</div>
        <div class="nossos-veiculos">Nossos veículos</div>
        <div class="sobre-nos">Sobre-nós</div>
        <div class="retangulo-laranja">
    <form action="../BackEnd/admin/Logout.php" method="post" style="margin: 0;">
        <button type="submit" style="background: none; border: none; color: white; font-size: 16px; cursor: pointer;">
            <strong>Deslogar</strong>
        </button>
    </form>
    </div>
    </div>


    <div class="container">
    <div id="info_cliente">
    <?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: Usuário não está logado.";
    exit();
}

include("../BackEnd/data/mySqlDataProvider.php");
include("../BackEnd/repositories/CarRepository.php");
include("../BackEnd/app/config.php");

// Chama a função para obter a conexão com o banco de dados
$conn = new MySqlDataProvider($config);

// Consulta SQL para obter os dados dos clientes
$sql = "SELECT id_cliente, email, telefone, nome FROM clientes WHERE id_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();


echo '<h2>' . $cliente['nome'] . "</h2>";
echo '<h2>' . $cliente['email'] . "</h2>";
echo '<h2>' . $cliente['telefone'] . "</h2>";
?>

</div>

<div id="titulo_hist">Histórico de Aluguéis</div>
<div id="dashboard_alugueis">
<?php
// Consulta para obter os veículos alugados
$sql2 = "SELECT l.id_cliente, l.data_fim, l.data_inicio, l.valor_total, v.marca, v.modelo, v.ano, v.imagem
         FROM veiculos v 
         INNER JOIN locacoes l ON v.id_veiculo = l.id_veiculo 
         WHERE l.id_cliente = ?";
$stmt2 = $conn->prepare($sql2);

if ($stmt2) {
    $stmt2->bind_param("i", $_SESSION['id_usuario']);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    while (($row = $result2->fetch_assoc())) {
        echo '<div id="car-card">';
        echo '<h3>Marca: ' . $row['marca'] . "</h3>";
        echo '<p>Modelo: ' . $row['modelo'] . "</p>";
        echo '<p>Ano: ' . $row['ano'] . "</p>";
        echo '<p>Diária: R$ ' . $row['valor_total'] . "</p>";
        echo '</div>';
    }
} else {
    echo "<p>Nenhum veículo alugado por você foi encontrado.</p>";
}
$stmt->close();
$stmt2->close();
?>
</div>
</div>

    
    <script></script>
</body>
</html>