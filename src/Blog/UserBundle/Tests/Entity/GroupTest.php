<?php

namespace Blog\UserBundle\Tests\Entity;

use Blog\UserBundle\Entity\Group;

class GroupTest extends \PHPUnit_Framework_TestCase
{
    protected $group;

    public function setUp()
    {
    	$group = $this->getMockBuilder('Sonata\UserBundle\Document')
			->disableOriginalConstructor()
			->getMock()
		;

        $this->group = new Group($group);
    }

    public function testId()
    {
        
    }
}
