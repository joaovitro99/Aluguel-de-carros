<?php



namespace Src\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->setupSMTP(); 
    }

    private function setupSMTP() {
        
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com'; 
        $this->mail->SMTPAuth = true;
        $this->mail->Username = ''; //email padrão do envio
        $this->mail->Password = ''; // senha do email padrao
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $this->mail->Port = 587; 
    }

    public function send($recipient, $message) {
        try {
            // Remetente e destinatário
            $this->mail->setFrom('', '');
            $this->mail->addAddress($recipient); // Adiciona o destinatário

            // Conteúdo do e-mail
            $this->mail->isHTML(true); // Configura o formato do e-mail como HTML
            $this->mail->Subject = 'Notificação'; // Assunto do e-mail
            $this->mail->Body    = $message; // Corpo da mensagem
            $this->mail->AltBody = strip_tags($message); // Texto alternativo para clientes que não suportam HTML

            
            $this->mail->send();
            
            return ["status" => "success", "message" => "E-mail enviado com sucesso!"];
        } catch (Exception $e) {
            return ["status" => "error", "message" => "Erro ao enviar e-mail: " . $this->mail->ErrorInfo];
        }
    }
}
