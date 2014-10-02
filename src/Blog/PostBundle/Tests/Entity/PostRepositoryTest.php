<?php

namespace Blog\PostBundle\Tests\Entity;

use Blog\PostBundle\Tests\DatabaseWeb;
use Blog\PostBundle\Entity\Post;

class PostRepositoryTest extends DatabaseWeb
{
    public function setUp()
    {
        parent::setUp();
        $this->factory->persistOnGet();

        $this->factory->persistOnGet();

        $tag = $this->factory->get('Blog\PostBundle\Entity\Tag');
        $post = $this->factory->get('Blog\PostBundle\Entity\Post');

        $post->addTag($tag);

        $this->em->flush();
    }

    public function testFindAllByTag()
    {
        $query = $this->em
            ->getRepository('BlogPostBundle:Post')
            ->findAllByTag(1)
        ;
        $post = $query->getResult();

        $this->assertEquals(1, count($post));
    }

    public function testFindAll()
    {
        $query = $this->em
            ->getRepository('BlogPostBundle:Post')
            ->findAllOrderedByDate(1)
        ;
        $post = $query->getResult();

        $this->assertEquals(1, count($post));
    }
}
