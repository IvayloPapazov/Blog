<?php

namespace Blog\UserBundle\Tests\Entity;

use Blog\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserTest extends \PHPUnit_Framework_TestCase
{
    protected $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function testImageName()
    {
        $this->user->setImageName("image");
        $this->assertEquals($this->user->getImageName(), "image");
    }

    public function testFile()
    {
        $file = new UploadedFile(
            'web/uploads/images/test.jpg',
            'test.jpg',
            'image/jpg',
            123
        );

        $this->user->setFile($file);
        $this->assertEquals($this->user->getFile(), $file);
    }
}
