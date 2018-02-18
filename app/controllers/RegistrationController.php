<?php
/**
 * RegistrationController
 */

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class RegistrationController
 *
 * @package App\Controllers
 */
class RegistrationController extends Controller
{

    /**
     * ユーザー登録のフォームを表示させる
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
            'title' => 'PHP OJT ユーザー登録',
        ];

        $response->getBody()->write($this->getTemplate()->render('registration/form.html', $renderParams));

        return $response;
    }

    /**
     * ユーザー登録の確認フォームを表示させる
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showConfirmForm(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        $renderParams = [
            'title' => 'PHP OJT ユーザー登録確認',
        ];

        $response->getBody()->write($this->getTemplate()->render('registration/confirm.html', $renderParams));

        return $response;
    }

    /**
     * ユーザー登録の完了メッセージを表示させる
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
            'title' => 'PHP OJT ユーザー登録完了',
        ];

        $response->getBody()->write($this->getTemplate()->render('registration/complete.html', $renderParams));

        return $response;
    }
}
