<?php

require_once __DIR__ . '/../app/router.php'; // Importa a classe Router
require_once __DIR__ . '/../app/controllers/HomeController.php'; // Importa o controlador padrão
require_once __DIR__ . '/../app/controllers/CarController.php'; // Importa o CarController
require_once __DIR__ . '/../app/controllers/IncomeController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/LoginController.php';
require_once __DIR__ . '/../app/controllers/LogoutController.php';
require_once __DIR__ . '/../app/controllers/ClientController.php';
require_once __DIR__ . '/../app/controllers/VehicleController.php';
//require_once __DIR__ . '/../app/controllers/NotificacaoController.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__."/../vendor/autoload.php";
// Configuração do roteador
$router = new Router();
$router->addRoute('car/index', 'CarController', 'index');
$router->addRoute('rendimento/index', 'IncomeController', 'index');
$router->addRoute('car/listar', 'CarController', 'listarCarros');
$router->addRoute('car/add', 'CarController', 'addCarro');
$router->addRoute('usuarios/index', 'UserController', 'index');
$router->addRoute('user/delete', 'UserController', 'delete');
$router->addRoute('car/delete', 'CarController', 'deleteCarro');
$router->addRoute('login/verificar', 'LoginController', 'verificarLogin');
$router->addRoute('login/index', 'LoginController', 'index');
$router->addRoute('user/showProfile', 'UserController', 'showProfile');
$router->addRoute('user/signup', 'ClientController', 'index');
$router->addRoute('logout', 'LogoutController', 'logout');
$router->addRoute('car/details', 'CarController', 'showDetailCar');
$router->addRoute('car/details', 'CarController', 'showDetailCar');

$router->addRoute('notificacao/criar', 'NotificacaoController', 'createNotification');
$router->addRoute('notificacao/pegar', 'NotificacaoController', 'listarNotificacoes');
// Obtém a URL da requisição
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Extrai a parte da URI da requisição
// Resolve a rota

$base_path = '/aluguel-de-carros/public/';
if (strpos($uri, $base_path) === 0) {
    $uri = substr($uri, strlen($base_path));
}


else if($uri === "notification/send" && $_SERVER['REQUEST_METHOD']=='POST'){
    require_once __DIR__."/../notificationsAPI/public/index.php";
   
   

}
else
{


    $route = $router->resolve($uri); // Busca a rota correspondente à URI

    // Instancia o controlador
    $controllerName = $route['controller']; // Obtém o nome do controlador
    $action = $route['action']; // Obtém a ação a ser chamada
    
    // Importa o controlador correspondente
    require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php';
    $controller = new $controllerName(); // Cria uma nova instância do controlador
    
    // Chama a ação do controlador
    if (method_exists($controller, $action)) { // Verifica se a ação existe no controlador
        $controller->$action(); // Chama a ação correspondente
    } else {
        http_response_code(404); // Define o código de resposta HTTP para 404
        echo "404 Not Found"; // Exibe uma mensagem de erro
    }
}
 



/*require_once __DIR__ . '/../controllers/VehicleController.php';
require_once __DIR__ . '/../app/config.php';

// Verifica se o ID do veículo foi passado pela URL
$id_veiculo = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_veiculo) {
    // Inicializa o controlador e exibe os detalhes do veículo
    $vehicleController = new VehicleController($conn);
    $vehicleController->showVehicleDetails($id_veiculo);
} else {
    echo "<p>ID do veículo não informado.</p>";
}
*/
