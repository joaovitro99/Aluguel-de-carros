<?php
// Inclua o arquivo que contém a classe MySqlDataProvider
require_once '../data/mySqlDataProvider.php';
require_once '../app/config.php';

// Crie uma instância do MySqlDataProvider
$db = new MySqlDataProvider($config);

// Verifique se o ID do veículo foi passado corretamente
if (isset($_POST['id_veiculo'])) {
    $id_veiculo = $_POST['id_veiculo'];

    // Prepare a query de exclusão
    $query = "DELETE FROM veiculos WHERE id_veiculo = ?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        // Vincule o parâmetro e execute a query
        $stmt->bind_param("i", $id_veiculo);
        $stmt->execute();

        // Feche o statement
        $stmt->close();
    }
}
?>
