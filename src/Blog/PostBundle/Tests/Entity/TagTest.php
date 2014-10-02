<?php

namespace Blog\PostBundle\Tests\Entity;

use Blog\PostBundle\Entity\Tag;

class TagTest extends \PHPUnit_Framework_TestCase
{
    protected $tag;

    public function setUp()
    {
        $this->tag = new Tag();
    }

    public function testId()
    {
        $this->tag->setId(1);
        $this->assertEquals($this->tag->getId(), 1);
    }

    public function testName()
    {
        $this->tag->setName('Image');
        $this->assertEquals($this->tag->getName(), 'Image');
        $this->assertEquals($this->tag->__toString(), 'Image');
    }
}
