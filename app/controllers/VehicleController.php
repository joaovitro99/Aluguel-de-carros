<?php
require_once __DIR__ . '/../repositories/CarRepository.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ .'/db.php';

class VehicleController {
    private $carRepository;

    public function __construct() {
        global $db_conection;
        $conn=$db_conection;
        // Inicializa o repositório de veículos
        $this->carRepository = new CarRepository($conn);
    }

    // Função que exibe os detalhes de um veículo específico
    public function showVehicleDetails() {
        $id_veiculo=$_GET['id'];
        // Obtém as informações do veículo através do repositório
        $vehicleInfo = $this->carRepository->getCar($id_veiculo);
       
        // Verifica se os dados do veículo foram recuperados corretamente
        if ($vehicleInfo) {
            // Obtém também as imagens do veículo (opcional, se não estiver no getCar)
            //$vehicleImages = $this->carRepository->getVehicleImages($id_veiculo);

            // Inclui a view que exibe os detalhes, passando os dados do veículo
            include __DIR__ . '/../views/DetalhesVeiculos.php';
        } else {
            echo "<p>Erro ao carregar as informações do veículo.</p>";
        }
    }
}
