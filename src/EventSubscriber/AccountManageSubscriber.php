<?php


namespace App\EventSubscriber;


use App\Entity\AccountManagement;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class AccountManageSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!($entity instanceof AccountManagement))
        {
            return;
        }

        $entity->getAccount()->updateFunds($entity->getMoney());

        $event['entity'] = $entity;
    }

}