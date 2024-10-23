<?php

require_once __DIR__ . '/db.php';

// Supondo que a conexão com o banco de dados seja feita corretamente no arquivo 'db.php'
global $db_conection;
$conn = $db_conection;

try {
    // Loop para inserir imagens de 1 a 10
    for ($id_veiculo = 1; $id_veiculo <= 10; $id_veiculo++) {
        // Define o caminho da imagem com base no ID do veículo
        $imagePath = 'C:/xampp/htdocs\Aluguel-de-carros\public\assets\images\imagens' . $id_veiculo . '.png';
        //$imagePath = 'C:\wamp64\www\Aluguel-de-carros\public\assets\images\imagens' . $id_veiculo . '.png';

        if (file_exists($imagePath)) {
            // Lê o conteúdo da imagem
            $imgData = file_get_contents($imagePath);

            // Prepare a consulta SQL para inserir a imagem
            $sql = "INSERT INTO imagens_veiculo (id_veiculo, imagem) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);

            // Verifique se a preparação da consulta foi bem-sucedida
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . $conn->error);
            }

            // Associe os parâmetros diretamente
            $stmt->bind_param("is", $id_veiculo, $imgData); // Altere 'i' para 'b' se estiver usando BLOB para armazenar imagens

            // Execute a inserção
            if ($stmt->execute()) {
                echo "Imagem para veículo ID $id_veiculo inserida com sucesso!<br>";
            } else {
                echo "Erro ao inserir a imagem para veículo ID $id_veiculo: " . $stmt->error . "<br>";
            }

            // Feche a declaração
            $stmt->close();
        } else {
            echo "Imagem não encontrada no caminho especificado para veículo ID $id_veiculo.<br>";
        }
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

/*
require_once __DIR__ . '/db.php';

// Supondo que a conexão com o banco de dados seja feita corretamente no arquivo 'db.php'
global $db_conection;
$conn = $db_conection;

try {
    $id_veiculo = 1; 
    $imagePath = 'C:/xampp/htdocs/aluguel-de-carros/public/assets/images/imagens1.png'; 

    if (file_exists($imagePath)) {
        // Lê o conteúdo da imagem
        $imgData = file_get_contents($imagePath);

        // Prepare a consulta SQL para inserir a imagem
        $sql = "INSERT INTO imagens_veiculo (id_veiculo, imagem) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Verifique se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            throw new Exception("Erro ao preparar a consulta: " . $conn->error);
        }

        // Associe os parâmetros diretamente
        $stmt->bind_param("is", $id_veiculo, $imgData); // Alterar o bind_param se necessário, ou pode usar os métodos abaixo

        // Execute a inserção
        if ($stmt->execute()) {
            echo "Imagem inserida com sucesso!";
        } else {
            echo "Erro ao inserir a imagem: " . $stmt->error;
        }

        // Feche a declaração
        $stmt->close();
    } else {
        echo "Imagem não encontrada no caminho especificado.";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
*/
?>