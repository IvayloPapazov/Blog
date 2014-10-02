<?php

namespace Blog\PostBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Blog\PostBundle\Entity\Tag;
use Blog\PostBundle\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;

class TagsTransformer implements DataTransformerInterface
{
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function transform($tags)
    {
        if (null === $tags) {
            return;
        }
        $tagsString = '';

        foreach ($tags as $tag) {
            $tagsString = $tag->getName();
        }
        
        return $tagsString;
    }

    public function reverseTransform($stringTags)
    {
        if (!$stringTags) {
            return null;
        }

        $tags = array_filter(explode(',', $stringTags));
        $tagEntities = $this->om
            ->getRepository('BlogPostBundle:Tag')
            ->findBy(array('name' => $tags))
        ;

        foreach ($tags as $tagName) {
            $found = false;
            foreach ($tagEntities as $tagEntity) {
                if ($tagName == $tagEntity->getName()) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $tag = new Tag();
                $tag->setName($tagName);
                $tagEntities[] = $tag;
            }
        }

        return new ArrayCollection($tagEntities);
    }
}
