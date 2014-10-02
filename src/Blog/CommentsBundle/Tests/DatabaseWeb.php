<?php

namespace Blog\CommentsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use FactoryGirl\Provider\Doctrine\FixtureFactory;
use FactoryGirl\Provider\Doctrine\FieldDef;
use Doctrine\ORM\Tools\SchemaTool;

class DatabaseWeb extends WebTestCase
{
    private $container;
    protected $em;

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();

        $this->container = static::$kernel->getContainer();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->generateSchema();

        $this->factory = new FixtureFactory($this->em);

        $this->factory->defineEntity(
            'Blog\UserBundle\Entity\User',
            array(
                'username' => FieldDef::sequence("user_%d@test.org"),
                'email' => FieldDef::sequence("user_%d@test.org"),
                'password' => 123,
            ),
            array(
                'afterCreate' => function ($user) {
                    $user->__construct();
                    $user->setEnabled(true);
                }
            )
        );

        $this->factory->defineEntity('Blog\PostBundle\Entity\Post', array(
            'title' => FieldDef::sequence("Title%d"),
            'content' => FieldDef::sequence("Content%d"),
            'tags' => FieldDef::sequence('Tags'),
            'imageName' => 'Image',
            'date' => new \DateTime(),
            'commentsCount' => 0
        ));


        $this->factory->defineEntity('Blog\CommentsBundle\Entity\Comment', array(
            'user' => FieldDef::reference('Blog\UserBundle\Entity\User'),
            'post' => FieldDef::reference('Blog\PostBundle\Entity\Post'),
            'content' => FieldDef::sequence('Content%d'),
            'date' => new \DateTime()
        ));
    }

    protected function loginAs($client, $user)
    {
        $session = $this->container->get('session');

        if (!$user) {
            throw new \InvalidArgumentException(
                'User does not exist in database.'
            );
        }

        // First Parameter is the actual user object.
        // 'main' is firewall name defined in security.yml
        $firewall = 'main';

        $token = new UsernamePasswordToken(
            $user,
            null,
            $firewall,
            $user->getRoles()
        );

        $this->container->get('security.context')->setToken($token);

        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }

    protected function generateSchema()
    {
        $metadata = $this->em->getMetadataFactory()->getAllMetadata();

        if (!empty($metadata)) {
            $tool = new SchemaTool($this->em);
            $tool->dropSchema($metadata);
            $tool->createSchema($metadata);
        }
    }
}
