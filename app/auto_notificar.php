
<?php

//script para rodar a consulta que vai enviar as notificaçõe
// é apenas para testar a api
require_once __DIR__.'/../app/controllers/RentalController.php';

$rental = new RentalController();
$rental->verificarNotificacao();

