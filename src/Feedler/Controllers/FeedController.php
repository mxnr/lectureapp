<?php

namespace Feedler\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedController
{
    public function feedAction($name)
    {
        var_dump($name);
        $a = 1;
        $b = 2;
        $c = $a+$b;

        return new Response('c = ' . $c);
    }
}
