<?php
include 'MySqlDataProvider.php';
include("config.php");
$dbProvider = new MySqlDataProvider($config);

// Verifica se o ID do veículo foi fornecido via GET
if (isset($_GET['id_veiculo'])) {
    $id_veiculo = $_GET['id_veiculo'];

    // Prepara a consulta para buscar as imagens associadas ao veículo
    $sql = "SELECT imagem FROM imagens_veiculo WHERE id_veiculo = ?";
    $stmt = $dbProvider->prepare($sql);
    
    if ($stmt) {
        // Faz o bind do parâmetro e executa a consulta
        $stmt->bind_param('i', $id_veiculo); // 'i' para indicar inteiro
        $stmt->execute();
        
        // Obtém os resultados
        $result = $stmt->get_result();
        
        // Exibe as imagens
        while ($row = $result->fetch_assoc()) {
            echo '<div class="slide">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagem']) . '" alt="Imagem do Veículo">';
            echo '</div>';
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        // Se a preparação da consulta falhar
        echo "Erro ao preparar a consulta: " . $dbProvider->$error;
    }
} else {
    // Caso o ID do veículo não tenha sido fornecido
    echo "ID do veículo não fornecido.";
}
?>