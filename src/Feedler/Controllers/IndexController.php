<?php

namespace Feedler\Controllers;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->render('index_page');
    }
}
