<?php

namespace Feedler\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedController extends BaseController
{
    public function feedAction($name)
    {
        return $this->render('feed');
    }
}
