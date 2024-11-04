<?php

namespace Src\Controllers;

use Src\Services\EmailService;
use Src\Services\SmsService;
use Src\Services\PushNotificationService;
require_once __DIR__."/../services/EmailService.php";

class NotificationController {
    public function sendNotification() {
        
        $type = $_POST['type'] ?? 'email';
        $recipient = $_POST['recipient'] ?? '';
        $message = $_POST['message'] ?? '';
        var_dump([$recipient,$message,$type]);
        

        if ($type === 'email') {
            $service = new EmailService();
            $result=$service->send($recipient, $message);
            //var_dump($result);
        } elseif ($type === 'sms') {
           // $service = new SmsService();
            //$service->send($recipient, $message);
        } elseif ($type === 'push') {
           // $service = new PushNotificationService();
            //$service->send($recipient, $message);
        } else {
            echo json_encode(["message" => "Tipo de notificação inválido"]);
        }
    }
}
