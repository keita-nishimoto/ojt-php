<?php
/**
 * Controller
 */

namespace App\Controllers;

/**
 * Class Controller
 *
 * @package App\Controllers
 */
abstract class Controller
{
    /**
     * @var \Twig_Environment
     */
    private $template;

    /**
     * Controller constructor.
     */
    final public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');

        $twig = new \Twig_Environment($loader, ['debug' => true]);
        $twig->addExtension(new \Twig_Extension_Debug());

        $this->setTemplate($twig);
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
