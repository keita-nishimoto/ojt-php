<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class UserController extends Controller
{
    /**
     * ユーザーを1件表示する
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return string
     */
    public function show(
        Request $request,
        Response $response,
        array $pathParams = []
    ) {
        try {
            $response->getBody()->write($this->getTemplate()->render('users/show.html'));

            return $response;
        } catch (\Twig_Error_Loader | \Twig_Error_Syntax | \Twig_Error_Runtime $e) {
            // TODO 後でエラー処理を追加する
        }
    }
}
