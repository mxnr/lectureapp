<?php

namespace Feedler\Service;

use Feedler\Models\CatModel;
use Feedler\Models\DogModel;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class FeedFactory
{
    public static function getFeed($name)
    {
        switch ($name) {
            case 'cats':
                return new CatModel();
                break;
            case 'dogs':
                return new DogModel();
                break;
            default:
                throw new ResourceNotFoundException();
        }
    }
}
