<?php
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
    $router->addRoute('GET', '/', 'index');
    $router->addRoute('GET', '/users/{user_id}', 'user');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        // 実行する関数名が入ってくる
        $handler = $routeInfo[1];

        // pathパラメータが入ってくる事を確認
        $vars = $routeInfo[2];

        echo $handler($vars);
        break;
    default:
        break;
}

function index($vars)
{
    require_once __DIR__ . '/views/index.php';

    return show();
}

function user($vars)
{
    echo '🐱🐶🐰';
}
