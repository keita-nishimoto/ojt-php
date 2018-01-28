<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

try {
    $app = new \Slim\App;
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
} catch (\Slim\Exception\NotFoundException $e) {
    // TODO 404 Not Found のレスポンスを返す
} catch (\Exception $e) {
    // TODO ここに入る時は重大な障害が起きているのでシステムエラーのページを表示させる
}
