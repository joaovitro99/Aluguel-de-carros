<?php

class WhatsAppController {
    private $nodeServerUrl = 'http://localhost:8000/send-message'; // URL do servidor Node.js

    /**
     * Envia uma mensagem de confirmação de tentativa de aluguel para o usuário no WhatsApp
     * @param string $userPhone - Número de telefone do usuário
     * @param string $vehicleInfo - Informações do veículo
     * @return array - Resposta com status de sucesso ou erro
     */
    public function sendRentalAttemptConfirmation($userPhone, $vehicleInfo) {
        $message = "Tentativa de aluguel registrada:\n";
        $message .= "Marca: {$vehicleInfo['marca']}\n";
        $message .= "Modelo: {$vehicleInfo['modelo']}\n";
        $message .= "Ano: {$vehicleInfo['ano']}\n";
        $message .= "Placa: {$vehicleInfo['placa']}\n";
        $message .= "Nossa equipe está verificando a disponibilidade. Em breve, entraremos em contato para confirmar o aluguel.";

        return $this->sendMessage($userPhone, $message);
    }

    private function sendMessage($to, $message) {
        $data = [
            'to' => $to,
            'message' => $message
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($this->nodeServerUrl, false, $context);

        if ($result === FALSE) {
            return ['status' => 'error', 'message' => 'Falha ao enviar mensagem'];
        }

        return json_decode($result, true);
    }
}
