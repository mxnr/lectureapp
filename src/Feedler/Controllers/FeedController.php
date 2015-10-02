<?php

namespace Feedler\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Feedler\Models\CatModel;
use Feedler\Models\DogModel;

class FeedController extends BaseController
{
    public function feedAction($name)
    {
        switch ($name) {
            case 'cats':
                $feedData = new CatModel();
                break;
            case 'dogs':
                $feedData = new DogModel();
                break;
            default:
                throw new Symfony\Component\Routing\Exception\ResourceNotFoundException();
        }

        return $this->render(
            'feed',
            array(
                'feedData' => $feedData->getPosts(),
                'title' => $feedData->getTitle(),
            )
        );
    }
}
