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
        if ($this->userRepository->deleteUsuario($_POST['id_cliente'])) {
            header("Location: /usuarios");
            exit();
        } else {
            echo "Erro ao excluir usuário.";
        }
    }
}

// Tratamento de POST para exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {
    $controller = new UserController($GLOBALS['db_conection']);
    $controller->delete($_POST['id_cliente']);
}
