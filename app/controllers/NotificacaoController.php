<?php
// controllers/NotificationController.php

use App\Repositories\Notification;
require_once __DIR__.'/../repositories/NotificacaoRepository.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../repositories/ClientRepository.php';
require_once __DIR__ . '/../repositories/CarRepository.php';
require_once("db.php");

class NotificacaoController {
    private $notification;

    public function __construct() {
        global $db_conection;
        $this->notification = new Notification($db_conection);
    }

    public function index() {
        // Renderiza a view principal ou a página inicial de notificações
        require_once __DIR__ . '/../views/NotificacaoUsuario.php';
    }

    public function listarNotificacoes($id_usuario){
        $notificacoes_cliente = $this->notification->getByClientId($id_usuario);

        // Renderiza a view e passa os dados
        require_once __DIR__ . '/../views/NotificacaoUsuario.php';
    }
}
