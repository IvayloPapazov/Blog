<?php

namespace Blog\CommentsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Blog\CommentsBundle\Entity\Comment;

class Upload implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preRemove',
        );
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Comment) {

            $post = $entity->getPost();
            $post->setCommentsCount($post->getCommentsCount()-1);
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Comment) {

            $post = $entity->getPost();
            $post->setCommentsCount($post->getCommentsCount()+1);
        }
    }
}
