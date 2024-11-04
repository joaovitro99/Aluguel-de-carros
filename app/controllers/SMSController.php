<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Certifique-se de que o autoload do Composer está incluído
use Twilio\Rest\Client;

class SMSController {
    private $twilio_sid;
    private $twilio_token;
    private $twilio_number;

    public function __construct() {
        // Configure as credenciais do Twilio aqui
        $this->twilio_sid = 'AC9c6f8f1a9ab5dde3153118a2f75ab639'; // Substitua pelo seu Account SID
        $this->twilio_token = '669b0c4bffc9e1fe391b4e485a980060'; // Substitua pelo seu Auth Token
        $this->twilio_number = '+12182108409'; // Substitua pelo seu número Twilio
    }

    /**
     * Envia uma mensagem SMS
     * @param string $to - Número de telefone do destinatário (no formato internacional: +5511999999999)
     * @param string $message - Conteúdo da mensagem a ser enviada
     * @return array - Resposta com status de sucesso ou erro
     */
    public function sendSMS($to, $message) {
        // Instancia o cliente Twilio
        $client = new Client($this->twilio_sid, $this->twilio_token);

        try {
            // Envia a mensagem
            $message = $client->messages->create(
                $to, // Número de destino
                [
                    'from' => $this->twilio_number, // Número remetente fornecido pelo Twilio
                    'body' => $message
                ]
            );

            return ['status' => 'success', 'message' => 'SMS enviado com sucesso!', 'sid' => $message->sid];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
