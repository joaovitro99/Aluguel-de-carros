<?php

require_once __DIR__ . '/../repositories/CarRepository.php';

class CarController {
    private $carRepository;

    public function __construct($dataProvider) {
        $this->carRepository = new CarRepository($dataProvider);
    }

    public function index() {
        $concessionarias = isset($_POST['concessionarias']) ? $_POST['concessionarias'] : [];
        $num_malas = isset($_POST['num_malas']) ? $_POST['num_malas'] : '';
        $min_price = isset($_POST['min_price']) ? $_POST['min_price'] : '';
        $max_price = isset($_POST['max_price']) ? $_POST['max_price'] : '';

        $cars = $this->carRepository->getFilteredCars($concessionarias, $num_malas, $min_price, $max_price);
        
        // Renderiza a view e passa os dados
        require_once __DIR__ . '/../views/buscacarrosview.php';
    }
}
