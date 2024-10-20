<?php
require_once(__DIR__.'/../repositories/RentalRepository.php');
require_once("db.php");

class IncomeController {
    private $rentalRepository;

    public function __construct() {
        global $db_conection;
        $this->rentalRepository = new RentalRepository($db_conection);
    }

    public function index() {
        $meses = isset($_GET['intervalo']) ? $_GET['intervalo'] : 'tudo';
        $rendimentos = $this->rentalRepository->getRendimentos($meses);

        if ($rendimentos === false) {
            $rendimentos = [];
        }

        require_once __DIR__ . '/../views/rendimento.php';
    }
}
