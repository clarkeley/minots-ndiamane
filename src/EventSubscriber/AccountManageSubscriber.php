<?php


namespace App\EventSubscriber;


use App\Entity\AccountManagement;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Security;

class AccountManageSubscriber implements EventSubscriber
{
    /**
     * @var Security
     */
    private $security;

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist
        ];
    }

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!($entity instanceof AccountManagement))
        {
            return;
        }

        $entity->getAccount()->updateFunds($entity->getMoney());
        $entity->setUpdateBy($this->security->getUser()->getUsername());

        $event['entity'] = $entity;
    }

}