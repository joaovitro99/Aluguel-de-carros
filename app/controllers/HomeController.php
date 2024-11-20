<?php
require_once(__DIR__.'/../repositories/CarRepository.php');
require_once("db.php");

use App\Repositories\CarRepository;
class HomeController {
    private $car_repository;

    public function __construct() {
        global $db_conection;
        $this->car_repository = new CarRepository($db_conection);
    }

    public function index() {
        $carros = [];
        $i = 0;
        $id = 1;

        while ($i < 5) {
            $model = $this->car_repository->getCar($id);
            if (is_array($model) && !empty($model)) {
                $carro = [
                    "marca" => $model['marca'],
                    "modelo" => $model['modelo'],
                    "capacidade_pessoas" => $model['capacidade_pessoas'],
                    "ano" => $model['ano'],
                    "cambio" => $model['cambio'],
                    "id" => $model['id_veiculo']
                ];
                array_push($carros, $carro);
                $i++;
            }
            $id++;
        }

        // Renderiza a view e passa os dados
        require_once(__DIR__.'/../views/pagina_inicial.php');
    }
}
