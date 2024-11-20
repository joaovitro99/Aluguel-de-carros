<?php
use App\Repositories\CarRepository;
require_once __DIR__ . '/../repositories/CarRepository.php';
require_once __DIR__ .'/db.php';

class CarController {
    private $carRepository;

    public function __construct() {
        global $db_conection;
        $this->carRepository = new CarRepository($db_conection);
    }

    public function index() {
        $concessionarias = isset($_GET['concessionarias']) ? $_GET['concessionarias'] : [];
        $num_malas = isset($_GET['num_malas']) ? $_GET['num_malas'] : '';
        $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
        $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';
    
        $cars = $this->carRepository->getFilteredCars($concessionarias, $num_malas, $min_price, $max_price);
    
        require_once __DIR__ . '/../views/buscacarros.php';
    }
    
    public function addCarro(){
            
    $marca = '';
    $modelo = '';
    $ano = null;
    $placa = '';
    $valor_diaria = null;
    $status = null;
    $capacidade_pessoas=null;
    $capacidade_bagageiro=null;
    $cambio='';
    $combustivel='';


    $errors = [];
    $status_bag=0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if (!empty($_POST['marca'])) {
            $marca = strtoupper(trim($_POST['marca']));
        } else {
            $errors[] = "A marca é obrigatória.";
        }

    
        if (!empty($_POST['modelo'])) {
            $modelo = trim($_POST['modelo']);
        } else {
            $errors[] = "O modelo é obrigatório.";
        }

    
        if (!empty($_POST['ano'])) {
            $ano = filter_var($_POST['ano'], FILTER_VALIDATE_INT);
            if (!$ano || $ano < 1886 || $ano > date('Y')) { 
                $errors[] = "Ano inválido.";
            }
        } else {
            $errors[] = "O ano é obrigatório.";
        }

        if (!empty($_POST['placa'])) {
            $placa = strtoupper(trim($_POST['placa']));
        
            if (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $placa) && !preg_match('/^[A-Z]{3}[0-9][A-Z][0-9]{2}$/', $placa)) {
                $errors[] = "Placa inválida.";
            }
        } else {
            $errors[] = "A placa é obrigatória.";
        }

        
        if (!empty($_POST['valorDiaria'])) {
            $valor_diaria = filter_var($_POST['valorDiaria'], FILTER_VALIDATE_FLOAT);
            if (!$valor_diaria || $valor_diaria <= 0) {
                $errors[] = "Valor da diária inválido.";
            }
        } else {
            $errors[] = "O valor da diária é obrigatório.";
        }

        
        if (isset($_POST['status'])) {
            $status = (int)$_POST['status'];
            if ($status < 1 || $status > 3) {
                $errors[] = "Status inválido.";
            }
        } else {
            $errors[] = "O status é obrigatório.";
        }

        if (!empty($_POST['capacidade_pessoas'])) {
            $capacidade_pessoas= filter_var($_POST['capacidade_pessoas'],FILTER_VALIDATE_INT);
        } else {
            $errors[] = "Numero de passageiros inválido ou não informado";
        }

        if (!empty($_POST['capacidade_bagageiro'])) {
            $capacidade_bagageiro= filter_var($_POST['capacidade_bagageiro'],FILTER_VALIDATE_FLOAT);
        } else {
            $errors[] = "Capacidade do bagageiro inválida ou não informada";
        }

        if (!empty($_POST['cambio'])) {
            $cambio= $_POST['cambio'];
        } else {
            $errors[] = "Tipo de câmbio não informado";
        }

        if (!empty($_POST['combustivel'])) {
            $combustivel= $_POST['combustivel'];
        } else {
            $errors[] = "Tipo de combustivel não informado";
        }
    
        if (empty($errors)) {
            $this->carRepository->insertCar($marca,$modelo,$ano,$placa,$valor_diaria,$status,$capacidade_pessoas,$capacidade_bagageiro,$cambio,$combustivel);
            echo "<script>
                alert('Carro inserido com sucesso!');
                window.location.href = '/aluguel-de-carros/public/car/listar';
            </script>";
            exit(); 
        } 

    
}}
public function deleteCarro() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idVeiculo = $_POST['id_veiculo'];
        
        // Remova o carro usando o método do repositório
        $this->carRepository->removeCar($idVeiculo);
        
        // Envie uma resposta de sucesso
        echo json_encode(['status' => 'success', 'message' => 'Carro removido com sucesso']);
        return;
    }

    // Envie uma resposta de erro se `id_veiculo` não for fornecido
    echo json_encode(['status' => 'error', 'message' => 'ID do veículo não foi fornecido']);
}

    
    public function listarCarros(){
        $veiculos = $this->carRepository->getAll();

        // Renderiza a view e passa os dados
        require_once __DIR__ . '/../views/veiculos.php';
    }
    public function showDetailCar(){
        global $db_conection;
        $id_veiculo = isset($_GET['id']) ? $_GET['id'] : null;
        $controller = new CarRepository($db_conection);

        if ($id_veiculo) {
            $controller->getCar($id_veiculo);
        } else {
            echo "ID do veículo não informado.";
        }

        require_once __DIR__ .'/../views/DetalhesVeiculos.php';

    }

    public function showResumoReserva() {
        // Obtenha o ID do carro a partir da URL
        $idCarro = $_GET['id'] ?? null;

        if ($idCarro) {
            // Busque as informações do carro pelo ID
            $carro = $this->carRepository->getCarById($idCarro);
            $_SESSION['reservaCarro']=$carro;

            // Calcular a diferença entre a data de retirada e devolução
            $dataRetirada = new DateTime($_SESSION['data_retirada'] ?? '');
            $dataDevolucao = new DateTime($_SESSION['data_devolucao'] ?? '');
            $intervalo = $dataRetirada->diff($dataDevolucao);
            $diasAlugados = $intervalo->days;
            $_SESSION['diasAlugados']=$diasAlugados;

            require_once __DIR__ . '/../views/Reserva.php'; // Carrega a view
        } else {
            echo "ID do veículo não informado.";
        }
    }
    
    public function buscar() {
        // Inicia a sessão caso ainda não esteja iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Captura os dados do formulário e os armazena na sessão
        $_SESSION['local'] = $_POST['local'] ?? '';
        $_SESSION['data_retirada'] = $_POST['data_retirada'] ?? '';
        $_SESSION['hora_retirada'] = $_POST['hora_retirada'] ?? '';
        $_SESSION['data_devolucao'] = $_POST['data_devolucao'] ?? '';
        $_SESSION['hora_devolucao'] = $_POST['hora_devolucao'] ?? '';

        // Redireciona de volta para a página de busca de carros
        header('Location: /aluguel-de-carros/public/car/index');
        
        exit;
    }
}
