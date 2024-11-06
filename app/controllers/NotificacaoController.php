<?php
// controllers/NotificationController.php
require_once 'repositories/NotificacaoRepository.php';

class NotificacaoController {
    private $notification;

    public function __construct() {
        global $db_conection;
        $this->notification = new Notification($db_conection);
    }

    

    public function listarNotificacoes($id_cliente){
        $notificacoes_cliente = $this->notification->getByClientId($id_cliente);

        // Renderiza a view e passa os dados
        require_once __DIR__ . '/../views/NotificacaoUsuario.php';
    }
}
