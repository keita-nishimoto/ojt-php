<?php

namespace App\Controllers;

use Zend\Diactoros\ServerRequest;

class UserController
{

    /**
     * ユーザーを1件表示する
     *
     * @param ServerRequest $request
     * @param array $pathParams
     * @param \Twig_Environment $template
     * @return string
     */
    public function show(ServerRequest $request, array $pathParams = [], \Twig_Environment $template)
    {
        try {
            return $template->render('index.html');
        } catch (\Twig_Error_Loader | \Twig_Error_Syntax | \Twig_Error_Runtime $e) {
            // TODO 後でエラー処理を追加する
        }
    }
}
