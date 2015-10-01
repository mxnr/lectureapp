<?php

namespace Feedler\Controllers;

class PageController extends BaseController
{
    public function helpAction()
    {
        return $this->render('help');
    }

    public function contactsAction()
    {
        return $this->render('contacts');
    }
}
