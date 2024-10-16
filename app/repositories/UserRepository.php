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

    public function getUserLogin($nome_usuario, $senha) {
        // Aqui você deve implementar a lógica para verificar o usuário e a senha
        $sql = "SELECT id_usuario, tipo_usuario FROM usuarios WHERE nome_usuario = ? AND senha = ?";
        $stmt = $this->dataProvider->prepare($sql);
        $stmt->bind_param("ss", $nome_usuario, $senha);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
