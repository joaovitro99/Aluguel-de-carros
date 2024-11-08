<?php

use Src\Controllers\NotificationController;

require_once __DIR__."/../src/controllers/NotificationController.php";

$controller= new NotificationController();
$action= "sendNotification";

$controller->$action();

