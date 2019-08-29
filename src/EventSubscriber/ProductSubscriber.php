<?php


namespace App\EventSubscriber;

use App\Entity\Category;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\ORMException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Entity\Products;

class ProductSubscriber implements EventSubscriber
{

    public function getSubscribedEvents()
    {
        return array(
            Events::preUpdate,
            Events::prePersist,
            Events::preRemove,
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!($entity instanceof Products)) {
            return;
        }

        $entity->getCategory()->addTotalWeightAndVolume($entity->getWeight(), $entity->getVolume());

        $event['entity'] = $entity;
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!($entity instanceof Products)) {
            return;
        }

        $entity->getCategory()->delTotalWeightAndVolume($entity->getWeight(), $entity->getVolume());

        $event['entity'] = $entity;
    }

    public function updateCategoryTotalWeightAndVolume(GenericEvent $args)
    {
        $entity = $args->getSubject();

        if (!($entity instanceof Products)) {
            return;
        }


        $args->getArgument('em')->refresh();
        $old = $args->getArgument('em')->getRepository(Products::class)->find($entity->getId());

        dd($old, $entity);



        $event['entity'] = $entity;
    }


    public function preUpdate(PreUpdateEventArgs $args)
    {
        /*$entity = $args->getEntity();

        $em = $args->getEntityManager();

        if (!($entity instanceof Products)) {
            return;
        }

        $args->getEntityManager()->refresh();

        $oldValue = $em->getRepository(Products::class)->find($entity->getId());

        dd($oldValue, $entity);

       /* $oldValue = $em->getRepository(Products::class)->find($entity->getId());

        dd($oldValue, $entity);

        $args['entity'] = $entity;

        $weight = $args->getNewValue('weight');
        $volume = $args->getNewValue('volume');

        if ($args->getEntity() instanceof Products) {
            if ($args->hasChangedField('weight') && $args->hasChangedField('volume')) {
                $args->setNewValue('weight', $weight);
                $args->setNewValue('volume', $volume);

            }
        }*/

        dd($args);
    }

}