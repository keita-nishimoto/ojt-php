<?php

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class PreregistrationController extends Controller
{

    /**
     * 仮ユーザー登録のフォームを表示させる
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showForm(
        Request $request,
        Response $response
    ) {
        $renderParams = [
            'title' => 'PHP OJT 仮ユーザー登録',
        ];

        $response->getBody()->write($this->getTemplate()->render('preregistration/form.html', $renderParams));

        return $response;
    }
}
