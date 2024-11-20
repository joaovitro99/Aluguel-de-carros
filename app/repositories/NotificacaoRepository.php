<?php

namespace App\Repositories;
// models/Notification.php
//require_once 'config/Database.php';
require_once __DIR__ .'/../controllers/db.php';
class Notification {
    private $conn;
    private $table_name = "notificacoes";

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    public function EnviarNotificacaoBD($id_cliente,$nome,$mensagem) {
        $query = "INSERT INTO " . $this->table_name . " (id_cliente, nome_cliente, texto_mensagem, data_envio) VALUES (?, ?, ?,NOW())";
        $stmt = $this->data_provider->prepare($query);
        $stmt->bind_param("iss", $id_cliente,$nome,$mensagem);

        return $stmt->execute();
    }

    public function getByClientId($id_cliente) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_cliente = ? ORDER BY data_envio DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
