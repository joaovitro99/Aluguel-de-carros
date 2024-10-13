<?php

require_once __DIR__ . '/../app/router.php'; // Importa a classe Router
require_once __DIR__ . '/../app/controllers/HomeController.php'; // Importa o controlador padrão

// Configuração do roteador
$router = new Router();

// Obtém a URL da requisição
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Extrai a parte da URI da requisição

// Resolve a rota
$route = $router->resolve($uri); // Busca a rota correspondente à URI

// Instancia o controlador
$controllerName = $route['controller']; // Obtém o nome do controlador
$action = $route['action']; // Obtém a ação a ser chamada

require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php'; // Importa o controlador correspondente
$controller = new $controllerName(); // Cria uma nova instância do controlador

// Chama a ação do controlador
if (method_exists($controller, $action)) { // Verifica se a ação existe no controlador
    $controller->$action(); // Chama a ação correspondente
} else {
    http_response_code(404); // Define o código de resposta HTTP para 404
    echo "404 Not Found"; // Exibe uma mensagem de erro
}
