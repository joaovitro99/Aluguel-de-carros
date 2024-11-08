<?php

    class Funcionario{
        public function insertFuncionario($nome, $senha) {
    // URL do endpoint da API
    $url = 'https://seuservidor.com/api/funcionarios';
    
    // Dados para enviar na requisição
    $data = [
        'nome' => $nome,
        'senha' => $senha
    ];

    // Inicializa o cURL
    $ch = curl_init($url);

    // Configurações da requisição
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);

    // Executa a requisição
    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Verifica erros
    if ($http_status !== 200) {
        throw new Exception("Erro ao inserir o funcionário: " . curl_error($ch));
    }

    // Fecha a conexão cURL
    curl_close($ch);

    // Retorna a resposta decodificada
    return json_decode($response, true);
}

    }