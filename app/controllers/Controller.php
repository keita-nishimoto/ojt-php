<?php

namespace App\controllers;

abstract class Controller
{
    /**
     * @var \Twig_Environment
     */
    private $template;

    /**
     * Controller constructor.
     */
    public final function __construct()
    {
        $loader = new \Twig_Loader_Filesystem( __DIR__ . '/../../templates');
        $this->setTemplate(new \Twig_Environment($loader));
    }

    /**
     * @return \Twig_Environment
     */
    protected function getTemplate(): \Twig_Environment
    {
        return $this->template;
    }

    /**
     * @param \Twig_Environment $template
     */
    private function setTemplate(\Twig_Environment $template): void
    {
        $this->template = $template;
    }
}
