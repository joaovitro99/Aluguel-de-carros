<?php

use Stripe\Terminal\Location;

require_once __DIR__.'/UserController.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/MySqlDataProvider.php';
require_once __DIR__.'/../../config/config.php';

class FuncionarioController {
    private $FuncionarioRepository;

    public function __construct() {
        global $db_conection;
        $this->FuncionarioRepository = new UserRepository($db_conection);
    }
    public function index(){
        require_once __DIR__.'/../views/Cadastro.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recupere os dados do formulário
            $nome_usuario = $_POST['nome_usuario'];
            $senha = $_POST['senha'];


        
            try {
                $this->FuncionarioRepository->insertFuncionario($nome_usuario,$senha);
                header("Location:/aluguel-de-carros/public/car/listar");
                echo "Funcionario Inserido!";
            } catch (Exception $e) {
                
                echo "Funcionario não foi inserido!";
            }
        }
    }
}
