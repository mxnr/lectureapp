<?php

namespace Feedler\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Feedler\Service\FeedFactory;

class FeedController extends BaseController
{
    public function feedAction($name)
    {
        $feedData = FeedFactory::getFeed($name);

        return $this->render(
            'feed',
            array(
                'feedData' => $feedData->getPosts(),
                'title' => $feedData->getTitle(),
            )
        );
    }
}
