<?php

namespace Blog\PostBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Blog\PostBundle\Entity\Post;

class UserPostCount implements EventSubscriber
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

        if ($entity instanceof Post) {

            $user = $entity->getUser();
            $user->setPostCount($user->getPostCount()-1);
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Post) {
            
            $user = $entity->getUser();
            $user->setPostCount($user->getPostCount()+1);
        }
    }
}
