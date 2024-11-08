<?php
session_start();
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../repositories/ClientRepository.php';
require_once __DIR__ . '/../repositories/CarRepository.php';
require_once("db.php");

class LoginController {
    private $carRepository;
    private $userRepository;
    private $clienteRepository;

    public function __construct(/*$db_connection*/) {
        global $db_conection;
        $this->carRepository = new CarRepository($db_conection);
        $this->userRepository = new UserRepository($db_conection); // Instancia o UserRepository
    }
    public function index(){
        require __DIR__."/../views/Login.php";
    }

    public function verificarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $nome_usuario = isset($_POST['nome_usuario']) ? trim($_POST['nome_usuario']) : null;
            $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

            // Validação
            if (empty($nome_usuario)) {
                $errors[] = "O nome de usuário é obrigatório.";
            }
            if (empty($senha)) {
                $errors[] = "A senha é obrigatória.";
            }

            // Se não houver erros, tenta realizar o login
            if (empty($errors)) {
                $user = $this->userRepository->getUserLogin($nome_usuario, $senha);
                //require_once __DIR__ . '/../views/usuarios.php';



                if ($user) {
                    $_SESSION['id_usuario'] = $user['id_usuario'];
                    $_SESSION['user']= $user;

                   
                    $direcao = ($user['tipo_usuario'] === 'cliente') ? '/aluguel-de-carros/public/user/showProfile' : '/aluguel-de-carros/public/car/listar';
                    echo "<script>
                        alert('Login feito com sucesso!');
                        window.location.href = '$direcao';
                      </script>";
                    exit();
                } else {
                    echo "<script>
                        alert('Usuário ou senha incorretos');
                        window.location.href = '/aluguel-de-carros/public/login/index';
                      </script>";
                    exit();
                }
            } else {
                // Exibir erros
                foreach ($errors as $error) {
                    echo "<script>
                        alert('$error');
                        window.location.href = '../../views/Login.php';
                      </script>";
                    exit();
                }
            }
        }
    }
}





