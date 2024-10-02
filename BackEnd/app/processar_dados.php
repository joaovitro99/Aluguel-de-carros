<?php
include '../data/mySqlDataProvider.php'; // Inclua o arquivo que contém a classe MySqlDataProvider
include '../repositories/ClientRepository.php'; // Inclua o arquivo que contém a classe ClientRepository
include '../app/config.php';

$dataProvider = new MySqlDataProvider($config);

// Crie uma instância da classe ClientRepository
$clientRepository = new ClientRepository($dataProvider);

// Verifique se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recupere os dados enviados pelo formulário
    $nome_usuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    // Tente inserir o cliente
    try {
        $clientRepository->insertClient($nome, $cpf, $email, $endereco, $telefone, $nome_usuario, $senha);
        echo "<p>Cliente cadastrado com sucesso!</p>";
        echo "<a href='../index.php'>Voltar para a página inicial</a>";
    } catch (Exception $e) {
        echo "<p>Erro ao cadastrar o cliente: " . $e->getMessage() . "</p>";
    }
}
