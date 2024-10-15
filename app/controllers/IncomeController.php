<?php
require_once(__DIR__.'/../repositories/RentalRepository.php');
require_once("db.php");

class IncomeController {
    private $rentalRepository;

    public function __construct()
    {
        global $db_conection;
        $this->rentalRepository = new RentalRepository($db_conection);
    }

    // Ação padrão para exibir a página de rendimento
    public function index() {

        // Renderiza a view e passa os dados de rendimento
        require_once __DIR__ . '/../views/rendimento.php';
    }
}
