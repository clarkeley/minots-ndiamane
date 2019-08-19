<?php


namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Entity\Products;

class ProductSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.pre_persist' => array('updateCategoryWeight'),
        );
    }

    public function updateCategoryWeight(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!($entity instanceof Products)) {
            return;
        }

        $entity->getCategory()->addTotalWeight($entity->getWeight());

        $event['entity'] = $entity;
    }

}