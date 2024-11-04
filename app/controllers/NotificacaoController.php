<?php
// controllers/NotificationController.php
require_once 'repositories/NotificacaoRepository.php';

class NotificacaoController {
    private $notification;

    public function __construct() {
        global $db_conection;
        $this->notification = new Notification($db_conection);
    }

    public function createNotification($data) {
        if (isset($data['message']) && isset($data['client_id'])) {
            $success = $this->notification->create($data['message'], $data['client_id']);
            return $success ? ["message" => "Notificação criada com sucesso!"] : ["message" => "Erro ao criar notificação."];
        } else {
            return ["message" => "Dados incompletos."];
        }
    }

    public function getNotifications($client_id) {
        if ($client_id) {
            return $this->notification->getByClientId($client_id);
        } else {
            return ["message" => "ID do cliente não especificado."];
        }
    }
}
