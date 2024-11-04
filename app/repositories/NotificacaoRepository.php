<?php
// models/Notification.php
require_once 'config/Database.php';

class Notification {
    private $conn;
    private $table_name = "notificacoes";

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    public function create($message, $client_id) {
        $query = "INSERT INTO " . $this->table_name . " (message, client_id, sent_at) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $message, $client_id);

        return $stmt->execute();
    }

    public function getByClientId($client_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE client_id = ? ORDER BY sent_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
