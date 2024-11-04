<?php

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

require_once 'controllers/WhatsAppController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'rentVehicle') {
    session_start();
    
    // Verifique se o usuário está logado e pegue as informações de contato do usuário
    if (isset($_SESSION['userPhone'])) {
        $userPhone = $_SESSION['userPhone'];
        
        // Pegue as informações do veículo do POST
        $vehicleInfo = [
            'marca' => $_POST['marca'],
            'modelo' => $_POST['modelo'],
            'ano' => $_POST['ano'],
            'placa' => $_POST['placa']
        ];

        // Envia a mensagem de tentativa de aluguel
        $whatsappController = new WhatsAppController();
        $response = $whatsappController->sendRentalAttemptConfirmation($userPhone, $vehicleInfo);

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuário não autenticado']);
    }
}
