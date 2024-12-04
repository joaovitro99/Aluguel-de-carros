<?php
require_once(__DIR__."/../../config/config.php");

global $config;
$db_conection;

if(defined('TEST_ENVIRONMENT')) {
    $db_connection = null;
} else {
    try {
        $db_conection = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
        
        if ($db_conection->connect_error) {
            throw new Exception("Falha na conexão: " . $db_conection->connect_error);
        }
    } catch (Exception $e) {
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
}