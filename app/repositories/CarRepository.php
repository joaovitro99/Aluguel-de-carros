<?php

class CarRepository{

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    public function insertCar($marca,$modelo,$ano,$placa,$valor_diaria,$status,$capacidade_pessoas,$capacidade_bagageiro,$cambio,$combustivel)
    {
        $sql= "INSERT INTO veiculos (marca, modelo, ano,placa,valor_diaria,status,capacidade_pessoas,capacidade_bagageiro,cambio,combustivel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

        $smt = $this->data_provider->prepare($sql);
        $smt ->bind_param("ssisdiidss",$marca,$modelo,$ano,$placa,$valor_diaria,$status,$capacidade_pessoas,$capacidade_bagageiro,$cambio,$combustivel);
        $smt->execute();



    }
    public function removeCar()
    {
        
    }
    public function updateCar()
    {
        
    }
    public function getCar($id) {
        $sql = "SELECT * FROM veiculos WHERE id_veiculo = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Verifica se algum carro foi encontrado
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Retorna um array associativo
        } else {
            return null; // Retorna null se não encontrou
        }
    }
    public function getAll()
    {
        
    }

    public function getFilteredCars($filters) {
        $sql = "SELECT v.*, i.imagem FROM veiculos v LEFT JOIN imagens_veiculo i ON v.id_veiculo = i.id_veiculo WHERE 1=1";
        $params = [];
        $types = "";

        if (!empty($filters['concessionarias'])) {
            $concessionariasList = "'" . implode("', '", $filters['concessionarias']) . "'";
            $sql .= " AND v.marca IN ($concessionariasList)";
        }

        if (!empty($filters['num_malas'])) {
            list($min_malas, $max_malas) = explode('-', $filters['num_malas']);
            $litros_por_mala = 70; // Cada mala ocupa 70 litros
            $capacidade_necessaria_min = $min_malas * $litros_por_mala;
            $capacidade_necessaria_max = $max_malas * $litros_por_mala;

            $sql .= " AND v.capacidade_bagageiro BETWEEN $capacidade_necessaria_min AND $capacidade_necessaria_max";
        }

        if (!empty($filters['min_price'])) {
            $sql .= " AND v.valor_diaria >= ?";
            $params[] = $filters['min_price'];
            $types .= "d"; // Tipo double
        }

        if (!empty($filters['max_price'])) {
            $sql .= " AND v.valor_diaria <= ?";
            $params[] = $filters['max_price'];
            $types .= "d"; // Tipo double
        }

        $stmt = $this->data_provider->prepare($sql);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}