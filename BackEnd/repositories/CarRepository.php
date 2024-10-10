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

}