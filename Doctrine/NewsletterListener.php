<?php
namespace Sescandell\SimpleNewsletterBundle\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Sescandell\SimpleNewsletterBundle\Model\NewsletterInterface;

class NewsletterListener implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->handleEvent($args);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->handleEvent($args);
    }

    private function handleEvent(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof NewsletterInterface) {
            $entity->setUpdatedAt(new \DateTime());

            if ($args instanceof PreUpdateEventArgs) {
                // We are doing an update, so we must force Doctrine
                // to update the changeset to take into account
                // the new Updated at value
                $em   = $args->getEntityManager();
                $uow  = $em->getUnitOfWork();
                $meta = $em->getClassMetadata(get_class($entity));
                $uow->recomputeSingleEntityChangeSet($meta, $entity);
            }
        }
    }
}
