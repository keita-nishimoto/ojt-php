<?php

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class LoginController extends Controller
{

    /**
     * ログインフォームを表示させる
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showForm(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        $renderParams = [
            'title' => 'PHP OJT ログイン',
        ];

        $response->getBody()->write($this->getTemplate()->render('login/form.html', $renderParams));

        return $response;
    }
}
