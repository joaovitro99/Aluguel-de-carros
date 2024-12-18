<?php
require_once __DIR__.'/../models/Cliente.php';
require_once __DIR__.'/../repositories/ClientRepository.php';
require_once __DIR__.'/MySqlDataProvider.php';
require_once __DIR__.'/../../config/config.php';

class ClientController {
    private $clientRepository;

    public function __construct() {
        global $db_conection;
        $this->clientRepository = new ClientRepository($db_conection);
    }
    public function index(){
        require_once __DIR__.'/../views/Cadastro.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recupere os dados do formulário
            $nome_usuario = $_POST['nome_usuario'];
            $senha = $_POST['senha'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];

            $client = new Client($nome_usuario, $senha, $nome, $cpf, $email, $endereco, $telefone);

        
            try {
                $this->clientRepository->insertClient(
                    $client->nome, $client->cpf, $client->email, 
                    $client->endereco, $client->telefone, 
                    $client->nome_usuario, $client->senha
                );
           
                header('Location: ../views/client_success.php');
            } catch (Exception $e) {
                
                header('Location: ../views/client_error.php?error=' . urlencode($e->getMessage()));
            }
        }
    }
}
