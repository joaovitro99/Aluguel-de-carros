<?php

$host = 'localhost';     
$dbname = 'carrobd';      
$username = 'root';       
$password = '';           
function getConnection() {
    global $host, $dbname, $username, $password;

    try {
        
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
    } catch (PDOException $e) {
       
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
}
?>