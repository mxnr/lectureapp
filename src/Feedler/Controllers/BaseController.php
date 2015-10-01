<?php

namespace Feedler\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class BaseController
{
    protected $generator;

    public function render($view)
    {
        ob_start();
        include __DIR__.'/../Resources/views/layout/header.php';
        include __DIR__.'/../Resources/views/'.$view.'.php';
        include __DIR__.'/../Resources/views/layout/footer.php';
        return new Response(ob_get_clean());
    }

    public function setGenerator(UrlGenerator $generator)
    {
        $this->generator = $generator;
    }
}
