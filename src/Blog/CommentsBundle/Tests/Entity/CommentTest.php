<?php

namespace Blog\CommentsBundle\Tests\Entity;

use Blog\CommentsBundle\Entity\Comment;
use Blog\UserBundle\Entity\User;
use Blog\PostBundle\Entity\Post;

class CommentsTest extends \PHPUnit_Framework_TestCase
{
    protected $comment;

    public function setUp()
    {
        $this->comment = new Comment();
    }

    public function testPostId()
    {
        $this->comment->setId(1);
        $this->assertEquals($this->comment->getId(), 1);
    }

    public function testContent()
    {
        $this->comment->setContent('Content');
        $this->assertEquals($this->comment->getContent(), 'Content');
    }

    public function testDate()
    {
        $date = new \DateTime();
        $this->comment->setDate($date);
        $this->assertEquals($this->comment->getDate(), $date);
    }

    public function testUser()
    {
        $user = new User();
        $user->setUsername('user');

        $this->comment->setUser($user);
        $this->assertEquals(
            $this->comment->getUser()->getUsername(),
            'user'
        );
    }

    public function testToString()
    {
        $this->comment->setContent('Content');
        $this->assertEquals($this->comment->__toString(), 'Content');
    }

    public function testPost()
    {
        $post = new Post();
        $post->setTitle('Title');

        $this->comment->setPost($post);
        $this->assertEquals($this->comment->getPost(), $post);

    }
}
