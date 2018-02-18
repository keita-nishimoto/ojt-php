<?php
/**
 * PreregistrationController
 */

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class PreregistrationController
 *
 * @package App\Controllers
 */
class PreregistrationController extends Controller
{

    /**
     * 仮ユーザー登録のフォームを表示させる
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
            'title' => 'PHP OJT 仮ユーザー登録',
        ];

        $response->getBody()->write($this->getTemplate()->render('preregistration/form.html', $renderParams));

        return $response;
    }

    /**
     * 仮ユーザー登録の完了メッセージを表示させる
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showCompleteMessage(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        $renderParams = [
            'title' => 'PHP OJT 仮ユーザー登録完了',
        ];

        $response->getBody()->write($this->getTemplate()->render('preregistration/complete.html', $renderParams));

        return $response;
    }
}
