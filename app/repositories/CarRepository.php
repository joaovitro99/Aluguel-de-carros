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
    public function removeCar($id_veiculo)
    {
        $query = "DELETE FROM veiculos WHERE id_veiculo = ?";
        $stmt = $this->data_provider->prepare($query);
    
        if ($stmt) {
            // Vincule o parâmetro e execute a query
            $stmt->bind_param("i", $id_veiculo);
            $stmt->execute();
    
            $stmt->close();
            
        }
        
    }
    public function updateCar()
    {
        
    }
    public function getCar($id_veiculo) {
        $sql = "SELECT * FROM veiculos WHERE id_veiculo = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("i", $id_veiculo);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Verifica se algum carro foi encontrado
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function getAll()
    {
        $sql = "SELECT * FROM veiculos";
        $stmt = $this->data_provider->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            return $stmt->get_result();
        } else {
            return false;
        }
    }
    

    public function getFilteredCars($concessionarias, $num_malas, $min_price, $max_price) {
        $conditions = [];
        if (!empty($concessionarias)) {
            $concessionariasList = "'" . implode("', '", $concessionarias) . "'";
            $conditions[] = "v.marca IN ($concessionariasList)";
        }
    
        // Lógica para lidar com o número de malas
        if (!empty($num_malas)) {
            list($min_malas, $max_malas) = explode('-', $num_malas);
            $litros_por_mala = 70;
            $capacidade_necessaria_min = $min_malas * $litros_por_mala;
            $capacidade_necessaria_max = $max_malas * $litros_por_mala;
            $conditions[] = "v.capacidade_bagageiro BETWEEN $capacidade_necessaria_min AND $capacidade_necessaria_max";
        }
    
        if (!empty($min_price)) {
            $conditions[] = "v.valor_diaria >= $min_price";
        }
        if (!empty($max_price)) {
            $conditions[] = "v.valor_diaria <= $max_price";
        }
    
        $sql = "SELECT v.id_veiculo, v.marca, v.modelo, v.ano, v.valor_diaria, i.imagem 
                FROM veiculos v 
                LEFT JOIN imagens_veiculo i ON v.id_veiculo = i.id_veiculo";
    
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }
    
        $stmt = $this->data_provider->query($sql);
    
        $cars = [];
        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                $cars[] = $row;
            }
        }
        return $cars;
    }    

    public function getVehicleImages($id_veiculo) {
        $sql = "SELECT imagem FROM imagens_veiculo WHERE id_veiculo = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("i", $id_veiculo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['imagem'];
        }
        return $images;
    }
    public function getUserCars($userId) {
        $sql = "SELECT * FROM locacoes WHERE id_cliente = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getCarById($id) {
        $stmt = $this->data_provider->prepare("SELECT * FROM veiculos WHERE id_veiculo = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getCarByterm($term){
        $stmt = $this->data_provider->prepare("SELECT * FROM veiculos WHERE modelo LIKE ? OR marca LIKE ? OR placa LIKE ?");
        $searchTerm = "%" . $term . "%";
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

    
}