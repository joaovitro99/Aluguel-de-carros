<?php

require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/Usuario.php';

class UserController {
    private $userRepository;

    public function __construct() {
        global $db_conection;
        $this->userRepository = new UserRepository($db_conection);
    }

    public function index() {
        $usuarios = $this->userRepository->getAllUsuarios();
        require_once __DIR__ . '/../views/usuarios.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cliente = $_POST['id_cliente'];
            
            // Remova o carro usando o método do repositório
            $this->userRepository->deleteUsuario($id_cliente);
            
            // Envie uma resposta de sucesso
            header("Location: /usuarios");
        }
    }
}