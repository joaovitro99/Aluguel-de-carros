<?php 
    $server = "localhost";
    $username = "root";
    $password = "aluguel@carros5";
    $dbname = "aluguelcarrobd";
    
    // Criar conexão
    $conexao = mysqli_connect($server, $username, $password, $dbname);
    
    // Verificar conexão
    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }
    
    // Mensagem de sucesso opcional
    echo "Conexão bem-sucedida!";



