<?php


namespace App\EventSubscriber;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductsRepository;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
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

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!($entity instanceof Products)) {
            return;
        }

        if ($args->hasChangedField('weight') || $args->hasChangedField('volume')) {
            /** @var CategoryRepository $productsRepository */
           $productsRepository =  $args->getEntityManager()->getRepository(Category::class);
           $category = $entity->getCategory();
           $category->delTotalWeightAndVolume($args->getOldValue('weight'), $args->getOldValue('volume'));
           $category->addTotalWeightAndVolume($args->getNewValue('weight'), $args->getNewValue('volume'));

            $productsRepository->updateTotalWeightAndVolume($category);


            //dd($entity->getCategory());
        }

        $event['entity'] = $entity;

    }

}