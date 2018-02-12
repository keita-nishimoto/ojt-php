<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$container = new \Slim\Container();
$container['notFoundHandler'] = function (\Slim\Container $container) {
    return function () use ($container) {
        $view = new \App\Views\ErrorView();

        return $container['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write($view->getNotFoundHtml());
    };
};

$container['notAllowedHandler'] = function (\Slim\Container $container) {
    return function () use ($container) {
        $view = new \App\Views\ErrorView();

        return $container['response']
            ->withStatus(405)
            ->withHeader('Content-Type', 'text/html')
            ->write($view->getNotAllowedHtml());
    };
};

$app = new \Slim\App($container);
$app->get('/', function (Request $request, Response $response, array $args) {
    $indexController = new \App\Controllers\IndexController();
    $indexController->showIndex($request, $response, $args);

    return $response;
});

$app->get('/preregistration', function (Request $request, Response $response) {
    $preregistrationController = new \App\Controllers\PreregistrationController();
    $preregistrationController->showForm($request, $response);

    return $response;
});

$app->get('/preregistration/complete', function (Request $request, Response $response) {
    $preregistrationController = new \App\Controllers\PreregistrationController();
    $preregistrationController->showCompleteMessage($request, $response);

    return $response;
});

$app->get('/login', function (Request $request, Response $response) {
    $loginController = new \App\Controllers\LoginController();
    $loginController->showForm($request, $response);

    return $response;
});

$app->get('/users/{userId}', function (Request $request, Response $response, array $args) {
    $userController = new \App\Controllers\UserController();
    $userController->showUser($request, $response, $args);

    return $response;
});

$app->run();
