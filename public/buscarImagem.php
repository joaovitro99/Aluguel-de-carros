<?php
include '../includes/db_connect.php'; // Certifique-se de que o caminho está correto

if (isset($_GET['id_veiculo'])) {
    $id_veiculo = $_GET['id_veiculo'];

    // Consulta para buscar as imagens associadas ao veículo
    $sql = "SELECT imagem FROM imagens_veiculo WHERE id_veiculo = :id_veiculo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_veiculo', $id_veiculo, PDO::PARAM_INT);
    $stmt->execute();

    // Exibe as imagens
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="slide">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagem']) . '" alt="Imagem do Veículo">';
        echo '</div>';
    }
}
?>
