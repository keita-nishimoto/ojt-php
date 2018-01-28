<?php

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends Controller
{
    /**
     * ユーザーを1件表示する
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return Response
     */
    public function showUser(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        try {
            $renderParams = [
                'title' => 'PHP OJT ユーザー',
            ];

            $response->getBody()->write($this->getTemplate()->render('users/show.html', $renderParams));

            return $response;
        } catch (\Twig_Error_Loader | \Twig_Error_Syntax | \Twig_Error_Runtime $e) {
            // TODO 後でエラー処理を追加する
        }
    }
}
