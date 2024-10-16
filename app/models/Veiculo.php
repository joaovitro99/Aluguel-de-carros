<?php

class Vehicle {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para obter informações do veículo
    public function getVehicleInfo($id_veiculo) {
        $sql_info = "SELECT marca, modelo, ano, placa, status, valor_diaria, cambio, capacidade_bagageiro, capacidade_pessoas, combustivel FROM veiculos WHERE id_veiculo = ?";
        $stmt = $this->conn->prepare($sql_info);
        if ($stmt) {
            $stmt->bind_param('i', $id_veiculo);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }
}

?>