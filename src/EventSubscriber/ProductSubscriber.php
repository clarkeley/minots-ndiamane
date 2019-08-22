<?php


namespace App\EventSubscriber;

use App\Entity\Category;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Entity\Products;

class ProductSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.pre_persist' => array('addCategoryWeightAndVolume'),
            'easy_admin.pre_remove' => array('delCategoryWeightAndVolume'),
        );
    }

    public function addCategoryWeightAndVolume(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!($entity instanceof Products)) {
            return;
        }

        $entity->getCategory()->addTotalWeightAndVolume($entity->getWeight(), $entity->getVolume());

        $event['entity'] = $entity;
    }

    public function delCategoryWeightAndVolume(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!($entity instanceof Products)) {
            return;
        }

        $entity->getCategory()->delTotalWeightAndVolume($entity->getWeight(), $entity->getVolume());

        $event['entity'] = $entity;
    }

}