<?php

namespace App\Views;

class ErrorView
{

    /**
     * 404 Not FoundページのHTMLを返す
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getNotFoundHtml(): string
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
            throw $e;
        }
    }

    /**
     * 405 Method Not AllowedページのHTMLを返す
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getNotAllowedHtml()
    {
        try {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');

            $twig = new \Twig_Environment($loader, ['debug' => true]);
            $twig->addExtension(new \Twig_Extension_Debug());

            $renderParams = [
                'title' => 'PHP OJT 405 Method Not Allowed',
            ];

            return $twig->render('errors/405.html', $renderParams);
        } catch (\Twig_Error_Loader | \Twig_Error_Syntax | \Twig_Error_Runtime $e) {
            throw $e;
        }
    }
}
