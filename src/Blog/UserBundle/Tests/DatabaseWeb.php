<?php

namespace Blog\UserBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Doctrine\ORM\Tools\SchemaTool;

class DatabaseWeb extends WebTestCase
{
    // private $container;
    // protected $em;

    // public function setUp()
    // {
    //     static::$kernel = static::createKernel();
    //     static::$kernel->boot();

    //     $this->container = static::$kernel->getContainer();

    //     $this->em = static::$kernel->getContainer()
    //         ->get('doctrine')
    //         ->getManager();

    //     $this->generateSchema();

    //     $this->factory = new FixtureFactory($this->em);

    //     $this->factory->defineEntity('Blog\UserBundle\Entity\Role', array(
    //         'name' => 'user',
    //         'role' => 'ROLE_USER'
    //     ));

    //     $this->factory->defineEntity('Blog\UserBundle\Entity\User', array(
    //         'firstName' => 'user',
    //         'lastName' => 'user',
    //         'username' => 'user',
    //         'password' => 'user',
    //         'email' => 'admin@admin.com',
    //         'isActive' => 1,
    //         'imageName' => 'image'
    //     ), array(
    //         'afterCreate' => function (\Blog\UserBundle\Entity\User $user, array $fieldValues) {
    //             $user->__construct();
    //         }
    //     ));
    // }

    // protected function loginAs($client, $user)
    // {
    //     $session = $this->container->get('session');

    //     if (!$user) {
    //         throw new \InvalidArgumentException(
    //             'User does not exist in database.'
    //         );
    //     }

    //     // First Parameter is the actual user object.
    //     // 'main' is firewall name defined in security.yml
    //     $firewall = 'main';

    //     $token = new UsernamePasswordToken(
    //         $user,
    //         null,
    //         $firewall,
    //         $user->getRoles()
    //     );

    //     $this->container->get('security.context')->setToken($token);

    //     $session->set('_security_'.$firewall, serialize($token));
    //     $session->save();

    //     $cookie = new Cookie($session->getName(), $session->getId());
    //     $client->getCookieJar()->set($cookie);
    // }

    // protected function getSecurityEncoder()
    // {
    //     return $this->container->get('security.encoder_factory');
    // }

    // protected function generateSchema()
    // {
    //     $metadata = $this->em->getMetadataFactory()->getAllMetadata();

    //     if (!empty($metadata)) {
    //         $tool = new SchemaTool($this->em);
    //         $tool->dropSchema($metadata);
    //         $tool->createSchema($metadata);
    //     }
    // }
}
