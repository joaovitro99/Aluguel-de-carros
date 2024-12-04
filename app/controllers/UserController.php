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
        $cliente = $this->clienteRepository->getClientById($_SESSION['id_cliente']);
       
        // Obtém os veículos do cliente
        $rentalHistory = $this->carRepository->getUserCars($_SESSION['id_usuario']);

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

    // Página de solicitação de redefinição de senha
    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            
            // Validate the email before processing
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->sendResetLink($email);
                header("Location: /aluguel-de-carros/public/user/forgotPassword?success=true");
                exit;
            } else {
                echo "E-mail inválido. Tente novamente.";
            }
        }
    
        require __DIR__ . '/../views/ForgotPassword.php';
    }

    // Processa o link de redefinição de senha e permite definir uma nova senha
    public function resetPassword() {
        $token = $_GET['token'] ?? null;
        if (!$token || !$this->isValidToken($token)) {
            echo "Token inválido ou expirado";
            exit();
        }

        require __DIR__ . '/../views/ResetPassword.php';
    }

    private function isValidToken($token) {
        return $this->userRepository->isValidToken($token);
    }
    
    public function sendResetLink($email) {
        // Gera um token e armazena no banco de dados com a validade
        $token = bin2hex(random_bytes(16));
        $expire = date("Y-m-d H:i:s", strtotime("+1 hour"));
    
        $this->userRepository->saveResetToken($email, $token, $expire);
    
        $resetLink = "http://localhost/aluguel-de-carros/public/user/resetPassword?token=$token";
    
        // Instanciar o RentalController para enviar o email
        $rentalController = new RentalController();
        return $rentalController->enviarEmailRecuperacao($email, "$resetLink");
    }

    public function updatePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $newPassword = $_POST['new_password'];
    
            $statusMessage = '';
            $statusClass = '';
    
            if ($this->isValidToken($token)) {
                $this->userRepository->updatePassword($token, password_hash($newPassword, PASSWORD_DEFAULT));
                $statusMessage = "Senha atualizada com sucesso!";
                $statusClass = 'success';
            } else {
                $statusMessage = "Token inválido ou expirado";
                $statusClass = 'error';
            }
    
            require __DIR__ . '/../views/updatePassword.php';
        }
    }
    public function buscarAdminFilter(){
        
        if (isset($_GET['term'])) {
            $term = $_GET['term'];
            $result=$this->userRepository->getUserByterm($term);

            $usuarios = [];
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }

            header('Content-Type: application/json');
            echo json_encode($usuarios);
           exit();
        }
        
    }
    
}