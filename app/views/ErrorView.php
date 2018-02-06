<?php

namespace App\Views;

class ErrorView
{

    /**
     * 404 Not FoundページのHTMLを返す
     *
     * @return string
     */
    public function notFound(): string
    {
        try {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');

            $twig = new \Twig_Environment($loader, ['debug' => true]);
            $twig->addExtension(new \Twig_Extension_Debug());

            $renderParams = [
                'title' => 'PHP OJT 404 Not Found',
            ];

            return $twig->render('errors/404.html', $renderParams);
        } catch (\Twig_Error_Loader | \Twig_Error_Syntax | \Twig_Error_Runtime $e) {
            // TODO 後でエラー処理を追加する
        }
    }
}
