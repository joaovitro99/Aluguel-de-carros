<?php

class Image {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para obter imagens do veículo
    public function getVehicleImages($id_veiculo) {
        $sql = "SELECT imagem FROM imagens_veiculo WHERE id_veiculo = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $id_veiculo);
            $stmt->execute();
            $result = $stmt->get_result();
            $images = [];
            while ($row = $result->fetch_assoc()) {
                $images[] = $row['imagem'];
            }
            return $images;
        }
        return null;
    }
}
?>