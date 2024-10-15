<?php
// Inclua o arquivo que contém a classe MySqlDataProvider
require_once '../data/mySqlDataProvider.php';
require_once '../app/config.php';

// Crie uma instância do MySqlDataProvider
$db = new MySqlDataProvider($config);

// Verifique se o ID do cliente foi passado corretamente
if (isset($_POST['id_cliente'])) {
    $id_cliente = $_POST['id_cliente'];

    // Prepare a query de exclusão
    $query = "DELETE FROM clientes WHERE id_cliente = ?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        // Vincule o parâmetro e execute a query
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();

        // Feche o statement
        $stmt->close();
    }
}
?>
