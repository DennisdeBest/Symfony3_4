<?php

namespace RC\CoreBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class UuidListener
 *
 * @package RedCarpet\Bundle\CoreBundle\EventListener
 */
class UuidListener
{
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Makes the link between a customer and an entity
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setUuid')) {
            try {
                $uuid = \Ramsey\Uuid\Uuid::uuid4();
                $entity->setUuid($uuid->toString());
            } catch (\Ramsey\Uuid\Exception\UnsatisfiedDependencyException $e) {
                // Some dependency was not met. Either the method cannot be called on a
                // 32-bit system, or it can, but it relies on Moontoast\Math to be present.
                $logger = $this->container->get('logger');
                $logger->error('Caught exception: ' . $e->getMessage());
            }
        }
    }
}
