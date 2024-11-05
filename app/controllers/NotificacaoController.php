<?php
// controllers/NotificationController.php
require_once 'repositories/NotificacaoRepository.php';

class NotificacaoController {
    private $notification;

    public function __construct() {
        global $db_conection;
        $this->notification = new Notification($db_conection);
    }

    

    public function getNotifications($client_id) {
        header('Content-Type: application/json');
    
        if (!$client_id) {
            echo json_encode(["error" => "ID do cliente não especificado."]);
            return;
        }
    
        try {
            $notifications = $this->notification->getByClientId($client_id);
    
            if (empty($notifications)) {
                return json_encode(["message" => "Sem notificações encontradas para o cliente."]);
            } else {
                return json_encode($notifications);
            }
        } catch (Exception $e) {
            return json_encode(["error" => "Erro ao buscar notificações: " . $e->getMessage()]);
        }
    }
}
