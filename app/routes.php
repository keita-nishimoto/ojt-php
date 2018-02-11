<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

try {
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

    $app->get('/users/{userId}', function (Request $request, Response $response, array $args) {
        $userController = new \App\Controllers\UserController();
        $userController->showUser($request, $response, $args);

        return $response;
    });

    $app->run();
} catch (\Slim\Exception\MethodNotAllowedException $e) {
    // TODO 405 Method Not Allowedのレスポンスを返す
} catch (\Exception $e) {
    // TODO ここに入る時は重大な障害が起きているのでシステムエラーのページを表示させる
}
