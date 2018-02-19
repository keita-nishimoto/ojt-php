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
     */
    public function showIndex(
        Request $request,
        Response $response,
        array $pathParams = []
    ): Response {
        try {
            $renderParams = [
                'title' => 'PHP OJT トップ',
            ];

            $response->getBody()->write($this->getTemplate()->render('index.html', $renderParams));

            return $response;
        } catch (\Twig_Error_Loader | \Twig_Error_Syntax | \Twig_Error_Runtime $e) {
            // TODO 後でエラー処理を追加する
        }
    }
}
