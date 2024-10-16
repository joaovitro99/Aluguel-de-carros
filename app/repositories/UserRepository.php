<?php

class UserRepository {
    private $dataProvider;

    public function __construct($dataProvider) {
        $this->dataProvider = $dataProvider;
    }

    public function getAllUsuarios() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->dataProvider->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $usuarios = [];
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = new Usuario($row);
            }
            return $usuarios;
        }
        return [];
    }

    public function deleteUsuario($id) {
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        $stmt = $this->dataProvider->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $id);
            return $stmt->execute();
        }
        return false;
    }
}
