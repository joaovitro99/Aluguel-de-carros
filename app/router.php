<?php
require_once __DIR__.'/controllers/WhatsAppController.php';
class Router {
    private $routes = []; // Array para armazenar as rotas

    // Método para adicionar uma nova rota
    public function addRoute($uri, $controller, $action) {
        $this->routes[$uri] = ['controller' => $controller, 'action' => $action]; // Armazena a rota
    }

    // Método para resolver a rota com base na URL
    public function resolve($uri) {
        // Verifica se a URI existe nas rotas
        if (array_key_exists($uri, $this->routes)) {
            return $this->routes[$uri]; // Retorna o controlador e a ação correspondentes
        } else {
            // Se a rota não existir, retorna uma rota padrão ou um erro
            return [
                'controller' => 'HomeController', // Controlador padrão
                'action' => 'index' // Ação padrão
            ];
        }
    }

}
require_once __DIR__.'/controllers/WhatsAppController.php';
//require_once __DIR__.'/controllers/SMSController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'rentVehicle') {
    session_start();
    
   
    if (isset($_SESSION['userPhone'])) {
        $userPhone = $_SESSION['userPhone'];
        
       
        $vehicleInfo = json_decode(file_get_contents('php://input'), true);
        
      
        $method = $_GET['method'];
        
        if ($method === 'whatsapp') {
            //$whatsappController = new WhatsAppController();
            $response = $whatsappController->sendRentalAttemptConfirmation($userPhone, $vehicleInfo);
        } else if ($method === 'sms') {
            //$smsController = new SMSController();
            //$response = $smsController->sendSMS($userPhone, "Confirmação de aluguel para o veículo: " . $vehicleInfo['marca'] . " " . $vehicleInfo['modelo']);
        } else {
            $response = ['status' => 'error', 'message' => 'Método inválido'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuário não autenticado']);
    }
}