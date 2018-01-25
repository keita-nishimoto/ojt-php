<?php
// Controllerのインスタンスを生成
$indexController = new \App\Controllers\IndexController();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
    $router->addRoute('GET', '/', '\\App\\Controllers\\IndexController::index');
    $router->addRoute('GET', '/users/{userId}', '\\App\\Controllers\\IndexController::index');
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

        $request = \Zend\Diactoros\ServerRequestFactory::fromGlobals();

        // pathパラメータが入ってくる事を確認
        $vars = $routeInfo[2];

        echo $handler($request, $vars);
        break;
    default:
        break;
}
