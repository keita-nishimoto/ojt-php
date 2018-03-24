<?php
/**
 * IndexController
 */

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class IndexController
 *
 * @package App\Controllers
 */
class IndexController extends Controller
{
    /**
     * トップページを表示させる
     *
     * @param Request $request
     * @param Response $response
     * @param array $pathParams
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showIndex(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        $renderParams = [
            'title' => 'PHP OJT トップ',
        ];

        $response->getBody()->write($this->getTemplate()->render('index.html', $renderParams));

        return $response;
    }
}
