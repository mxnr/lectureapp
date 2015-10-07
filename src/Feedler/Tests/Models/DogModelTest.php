<?php

namespace Feedler\Tests\Models;

use Feedler\Models\DogModel;

class DogModelTest extends \PHPUnit_Framework_TestCase
{
    private $dogModel;

    public function setUp()
    {
        $this->dogModel = new DogModel();
    }

    public function testGetTitle()
    {
        $this->assertEquals('Список собачек', $this->dogModel->getTitle());
    }

    public function testGetPosts()
    {
        $this->assertInternalType('array', $this->dogModel->getPosts());
        $this->assertCount(20, $this->dogModel->getPosts());
    }
}
