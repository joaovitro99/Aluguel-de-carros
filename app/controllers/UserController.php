<?php

require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../repositories/ClientRepository.php';
require_once __DIR__ . '/../repositories/CarRepository.php';

class UserController {
    private $userRepository;
    private $clienteRepository;
    private $carRepository;

    public function __construct() {
        global $db_conection;
        $this->userRepository = new UserRepository($db_conection);
        $this->clienteRepository = new ClientRepository($db_conection);
        $this->carRepository = new CarRepository($db_conection);
    }

    public function index() {
        $usuarios = $this->userRepository->getAllUsuarios();
        require_once __DIR__ . '/../views/usuarios.php';
    }

    public function showProfile() {
        if (!isset($_SESSION['id_usuario'])) {
            echo "Erro: Usuário não está logado.";
            exit();
        }

        // Obtém os dados do cliente
        $cliente = $this->clienteRepository->getClient($_SESSION['id_usuario']);
        
        // Obtém os veículos do cliente
        $rentalHistory = $this->carRepository->getUserCars($_SESSION['id_usuario']);

        // Carrega a view
        require '../app/views/perfil.php';
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