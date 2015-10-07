<?php

namespace Feedler\Tests\Service;

use Feedler\Service\FeedFactory;

class FeedFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFeedCat()
    {
        $this->assertInstanceOf('Feedler\Models\CatModel', FeedFactory::getFeed('cats'));
    }

    public function testGetFeedDog()
    {
        $this->assertInstanceOf('Feedler\Models\DogModel', FeedFactory::getFeed('dogs'));
    }

    /**
     * @expectedException Symfony\Component\Routing\Exception\ResourceNotFoundException
     */
    public function testGetFeedException()
    {
        FeedFactory::getFeed('fish');
    }
}
