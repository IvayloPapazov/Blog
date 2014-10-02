<?php

namespace Blog\PostBundle\Tests\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Blog\PostBundle\Entity\Post;
use Blog\PostBundle\Entity\Tag;
use Blog\UserBundle\Entity\User;
use Blog\UserBundle\Entity\Role;
use Blog\CommentsBundle\Entity\Comment;
use Doctrine\Common\Collections\ArrayCollection;

class PostTest extends \PHPUnit_Framework_TestCase
{
    protected $post;

    public function setUp()
    {
        $this->post = new Post();
    }

    public function testId()
    {
        $this->post->setId(1);
        $this->assertEquals($this->post->getId(), 1);
    }

    public function testTitle()
    {
        $this->post->setTitle('Title');
        $this->assertEquals($this->post->getTitle(), 'Title');
    }

    public function testContent()
    {
        $this->post->setContent('Content');
        $this->assertEquals($this->post->getContent(), 'Content');
    }

    public function testCommentsCount()
    {
        $this->post->setCommentsCount(1);
        $this->assertEquals($this->post->getCommentsCount(), 1);
    }

    public function testDate()
    {
        $date = new \DateTime();
        $this->post->setDate($date);
        $this->assertEquals($this->post->getDate(), $date);
    }

    public function testFile()
    {
        $file = new UploadedFile(
            'web/uploads/images/test.jpg',
            'test.jpg',
            'image/jpg',
            123
        );

        $this->post->setFile($file);
        $this->assertEquals($this->post->getFile(), $file);
    }

    public function testImageName()
    {
        $this->post->setImageName('Image');
        $this->assertEquals($this->post->getImageName(), 'Image');
    }

    public function testUser()
    {
        $user = new User();
        $user->setUsername('name');

        $this->post->setUser($user);
        $this->assertEquals(
            $this->post->getUser()->getUsername(),
            'name'
        );
    }

    public function testTag()
    {
        $tag = new Tag();
        $tag->setName('tag');

        $this->post->addTag($tag);
        $this->assertEquals(
            $this->post->getTags()->first()->getName(),
            'tag'
        );
    }

    public function testComment()
    {
        $comment = new Comment();
        $comment->setContent('Content');

        $this->post->addComment($comment);
        $this->assertEquals($this->post->getComments()->first()->getContent(), 'Content');
    }

    public function testTags()
    {
        $comment = new ArrayCollection();
        $comment[] = 'tag';

        $this->post->setTags($comment);
        $this->assertEquals($this->post->getTags()->first(), 'tag');

    }
}
