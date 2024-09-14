<?php

$host = 'localhost';     
$dbname = 'carrobd';      
$username = 'root';       
$password = '';           
function getConnection() {
    global $host, $dbname, $username, $password;

    try {
        // Criação da conexão PDO
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        
        // Definir o modo de erro do PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
    } catch (PDOException $e) {
        // Em caso de erro de conexão, uma mensagem personalizada pode ser exibida
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
}
?>