<?php

require_once __DIR__ . '/../app/router.php'; // Importa a classe Router
require_once __DIR__ . '/../app/controllers/HomeController.php'; // Importa o controlador padrão
require_once __DIR__ . '/../app/controllers/CarController.php'; // Importa o CarController
require_once __DIR__ . '/../app/controllers/IncomeController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/LoginController.php';
require_once __DIR__ . '/../app/controllers/LogoutController.php';
require_once __DIR__ . '/../app/controllers/ClientController.php';

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
// Obtém a URL da requisição
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Extrai a parte da URI da requisição
// Resolve a rota

$base_path = '/aluguel-de-carros/public/';
if (strpos($uri, $base_path) === 0) {
    $uri = substr($uri, strlen($base_path));
}
 
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


/*include '../controllers/CarController.php';
include '../app/config.php';

$id_veiculo = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_veiculo) {
    $controller = new VehicleController($conn);
    $controller->showVehicle($id_veiculo);
} else {
    echo "ID do veículo não informado.";
}*/


