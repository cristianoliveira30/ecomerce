<?php
require_once __DIR__ . '/../app/Core/Router.php';

$router = new Router();

// Rotas básicas
$router->get('/', function() use ($router) {
    $router->renderView('home', ['title' => 'Página Inicial']);
});

$router->get('/contato', function() use ($router) {
    $router->renderView('contato', ['title' => 'Fale Conosco']);
});

$router->dispatch();
