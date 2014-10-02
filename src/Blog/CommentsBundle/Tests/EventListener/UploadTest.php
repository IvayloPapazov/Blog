<?php

namespace Blog\CommentsBundle\Tests\EventListener;

use Blog\CommentsBundle\EventListener\Upload;
use Blog\CommentsBundle\Entity\Comment;
use Blog\PostBundle\Entity\Post;
use Doctrine\Common\Persistence\ObjectManager;

class UploadTest extends \PHPUnit_Framework_TestCase
{
	protected $upload;
	protected $lifecycle;
	protected $post;

	public function setUp()
	{
		$comment = new Comment();
		$this->post = new Post();
		$comment->setPost($this->post);

		$this->upload = new Upload();

		$repo = $this->getMockBuilder('Doctrine\ORM\EntityManager')
			->disableOriginalConstructor()
			->getMock()
		;

		$this->lifecycle = $this->getMockBuilder('Doctrine\ORM\Event\LifecycleEventArgs')
			->disableOriginalConstructor()
			->getMock()
		;

		$this->lifecycle->expects($this->any())
			->method('getEntity')
			->will($this->returnValue($comment))
		;
		
	}

	public function testPreRemove()
	{
		$this->upload->preRemove($this->lifecycle);
		$this->assertEquals($this->post->getCommentsCount(), -1);
	}

	public function testPrePersist()
	{
		$this->upload->prePersist($this->lifecycle);
		$this->assertEquals($this->post->getCommentsCount(), 1);
	}

	public function testGetSubscribedEvents()
	{
		$result = $this->upload->getSubscribedEvents();
		$this->assertEquals($result, array('prePersist', 'preRemove'));
	}
}
