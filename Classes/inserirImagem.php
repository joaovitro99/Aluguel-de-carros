<?php
include '../includes/db_connect.php'; // Certifique-se de que o caminho do arquivo de conexão está correto
$conn = getConnection();
try {
    // Define o ID do veículo para o qual deseja associar a imagem
    $id_veiculo = 1; // Você pode alterar conforme necessário

    // Caminho absoluto da imagem no seu sistema local
    $imagePath = 'C:/xampp/htdocs/img/carro1.png'; // Substitua pelo caminho correto da imagem

    // Verifica se a imagem existe no caminho
    if (file_exists($imagePath)) {
        // Lê o conteúdo da imagem
        $imgData = file_get_contents($imagePath);

        // Insere a imagem no banco de dados
        $sql = "INSERT INTO imagens_veiculo (id_veiculo, imagem) VALUES (:id_veiculo, :imagem)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_veiculo', $id_veiculo, PDO::PARAM_INT);
        $stmt->bindParam(':imagem', $imgData, PDO::PARAM_LOB);

        if ($stmt->execute()) {
            echo "Imagem inserida com sucesso!";
        } else {
            echo "Erro ao inserir a imagem.";
        }
    } else {
        echo "Imagem não encontrada no caminho especificado.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
