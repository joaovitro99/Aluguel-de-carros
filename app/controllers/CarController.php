<?php
require_once 'db.php';
require_once(__DIR__ . '/../repositories/CarRepository.php');
require_once __DIR__ . '/../../config/config.php'; // Corrigido para o caminho correto

class CarController {
    private $carRepository;

    public function __construct() {
        $conn = new MySqlDataProvider($GLOBALS['config']);
        $this->carRepository = new CarRepository($conn);
    }

    public function index() {
        $concessionarias = $_POST['concessionarias'] ?? [];
        $num_malas = $_POST['num_malas'] ?? '';
        $min_price = $_POST['min_price'] ?? '';
        $max_price = $_POST['max_price'] ?? '';

        $filters = [
            'concessionarias' => $concessionarias,
            'num_malas' => $num_malas,
            'min_price' => $min_price,
            'max_price' => $max_price,
        ];

        $cars = $this->carRepository->getFilteredCars($filters);
        require '../public/views/BuscaCarrosView.php';
    }
}
