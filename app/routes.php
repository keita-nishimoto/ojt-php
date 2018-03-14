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

    return $indexController->showIndex($request, $response, $args);
});

$app->get('/preregistration', function (Request $request, Response $response, array $args) {
    $preregistrationController = new \App\Controllers\PreregistrationController();

    return $preregistrationController->showForm($request, $response, $args);
});

$app->post('/preregistration', function (Request $request, Response $response, array $args) {
    $preregistrationController = new \App\Controllers\PreregistrationController();

    return $preregistrationController->postToForm($request, $response, $args);
});

$app->get('/preregistration/complete', function (Request $request, Response $response, array $args) {
    $preregistrationController = new \App\Controllers\PreregistrationController();

    return $preregistrationController->showCompleteMessage($request, $response, $args);
});

$app->get('/registration/{token}', function (Request $request, Response $response, array $args) {
    $registrationController = new \App\Controllers\RegistrationController();

    return $registrationController->showForm($request, $response, $args);
});

$app->post('/registration/{token}', function (Request $request, Response $response, array $args) {
    $registrationController = new \App\Controllers\RegistrationController();

    return $registrationController->showForm($request, $response, $args);
});

$app->post('/registration/{token}/confirm', function (Request $request, Response $response, array $args) {
    $registrationController = new \App\Controllers\RegistrationController();

    return $registrationController->showConfirmForm($request, $response, $args);
});

$app->post('/registration/{token}/complete', function (Request $request, Response $response, array $args) {
    $registrationController = new \App\Controllers\RegistrationController();

    return $registrationController->showCompleteMessage($request, $response, $args);
});

$app->get('/login', function (Request $request, Response $response) {
    $loginController = new \App\Controllers\LoginController();

    return $loginController->showForm($request, $response);
});

$app->get('/users/{userId}', function (Request $request, Response $response, array $args) {
    $userController = new \App\Controllers\UserController();

    return $userController->showUser($request, $response, $args);
});

$app->run();
