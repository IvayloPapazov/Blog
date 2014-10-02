<?php

namespace Blog\PostBundle\Tests\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Blog\PostBundle\Tests\DatabaseWeb;

class PostControllerTest extends DatabaseWeb
{
    private $client = null;
    protected $user;
    
    public function setUp()
    {
        $this->client = static::createClient();
        
        parent::setUp();

        $this->factory->persistOnGet();
        $this->user = $this->factory->get('Blog\UserBundle\Entity\User');
        $this->factory->get('Blog\PostBundle\Entity\Post');
        $this->factory->get('Blog\PostBundle\Entity\Tag');
        $this->em->flush();
    }

    public function testListPage()
    {
        $crawler = $this->client->request('GET', '/en/posts/list');
        $this->assertEquals(1, $crawler->filter('.panel-heading')->count());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testShowPostNotExist()
    {
        $crawler = $this->client->request('GET', '/en/posts/post/999');
        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }

    public function testShowPostExist()
    {
        $crawler = $this->client->request('GET', '/en/posts/post/1');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testCreatePostNotLogin()
    {
        $crawler = $this->client->request('GET', '/en/posts/create');

        $this->assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testCreatePostLogin()
    {
        $this->loginAs($this->client, $this->user);
        $crawler = $this->client->request('GET', '/en/posts/create');

        $file = $this->getMockBuilder(
            'Symfony\Component\HttpFoundation\File\UploadedFile'
        )
            ->setConstructorArgs(
                array(
                    'web/uploads/images/test.jpg',
                    'test.jpg'
                )
            )
            ->getMock()
        ;

        $file->expects($this->any())
            ->method('move')
            ->with($this->anything())
        ;

        $form = $crawler->selectButton('post[Save]')->form(array(
            'post[title]' => 'Title',
            'post[content]' => 'Content content',
            'post[tags]' => 'Tag',
            'post[file]' => $file
        ));
        $this->client->submit($form);

        // echo ($this->client->getResponse()->getContent());
        $this->assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
        );
        
        $this->assertTrue(
            $this->client->getResponse()->isRedirect('/en/posts/list')
        );
    }

    public function testTagList()
    {
        $this->loginAs($this->client, $this->user);
        $this->client->request('GET', '/en/posts/list/tag/1/1');
      
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
