<?php

namespace Blog\CommentsBundle\Tests\Controller;

use Blog\CommentsBundle\Tests\DatabaseWeb;

class CommentsControllerTest extends DatabaseWeb
{
    private $client = null;
    private $user;

    public function setUp()
    {
        $this->client = static::createClient();

        parent::setUp();

        $this->factory->persistOnGet();
        $this->user = $this->factory->get('Blog\UserBundle\Entity\User');
        $this->factory->get('Blog\PostBundle\Entity\Post');
        $this->factory->get('Blog\CommentsBundle\Entity\Comment');
        $this->em->flush();
    }

    public function testFormView()
    {
        $crawler = $this->client->request('GET', '/en/posts/post/1');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testCreate()
    {
        $this->loginAs($this->client, $this->user);
        $crawler = $this->client->request('GET', '/en/posts/create');

        $crawler = $this->client->request(
            'GET',
            '/en/posts/post/1'
        );
        $form = $crawler->selectButton('comment[Save]')->form(array(
            
            'comment[content]' => 'Content'
        ));

        $this->client->submit($form);

        $this->assertEquals(
            302,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testCreateNotFoundPost()
    {
        $this->client->request(
            'POST',
            '/en/comments/999',
            array('comment[content]' => 'content')
        );

        $this->assertEquals(
            404,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testCreateNotValidForm()
    {
        $this->client->request(
            'POST',
            '/en/comments/1',
            array('comment[content]' => '')
        );

        $crawler = $this->client->followRedirect();
        $this->assertEquals(1, $crawler->filter('.bg-danger')->count());
    }
}
