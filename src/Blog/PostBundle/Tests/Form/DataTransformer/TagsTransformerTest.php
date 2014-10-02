<?php

namespace Blog\PostBundle\Tests\DataTransformer;

use Blog\PostBundle\Form\DataTransformer\TagsTransformer;
use Blog\PostBundle\Entity\Tag;

class TagsTransformerTest extends \PHPUnit_Framework_TestCase
{
    protected $tagsTransformer;
    protected $tagEntities;
    protected $tag;

    public function setUp()
    {
        $this->tag = new Tag();
        $this->tag->setName('tag');
        $this->tagEntities[] = $this->tag;

        $repo = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $repo->expects($this->any())
            ->method("findBy")
            ->will($this->returnValue($this->tagEntities))
        ;

        $om = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $om->expects($this->any())
            ->method("getRepository")
            ->with('BlogPostBundle:Tag')
            ->will($this->returnValue($repo))
        ;

        $this->tagsTransformer = new TagsTransformer($om);
    }

    public function testTransform()
    {
        $this->assertEquals($this->tagsTransformer->transform($this->tagEntities), 'tag');
    }

    public function testTransformNull()
    {
        $this->tagsTransformer->transform(null);
    }

    public function testReverseTransform()
    {
        $stringTags = 'tag, tags';
        $result = $this->tagsTransformer->reverseTransform($stringTags);

        $this->assertEquals($result[0]->getName(), 'tag');
        $this->assertEquals($result[1]->getName(), ' tags');
    }

    public function testReverseTransformEmpty()
    {
        $stringTags = '';
        $this->assertEmpty($this->tagsTransformer->reverseTransform($stringTags));
    }
}
