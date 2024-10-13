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
