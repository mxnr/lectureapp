<?php

namespace Feedler\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController
{
    public function pageAction()
    {
        $a = 1;
        $b = 2;
        $c = $a+$b;

        return new Response('c = ' . $c);
    }
}
