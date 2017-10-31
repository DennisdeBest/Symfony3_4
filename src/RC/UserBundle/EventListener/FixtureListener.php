<?php

namespace RC\UserBundle\EventListener;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sylius\Bundle\FixturesBundle\Listener\AbstractListener;
use Sylius\Bundle\FixturesBundle\Listener\BeforeSuiteListenerInterface;
use Sylius\Bundle\FixturesBundle\Listener\SuiteEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixtureListener extends AbstractListener implements BeforeSuiteListenerInterface
{

    private $container;

    private $entityManager;

    public function __construct(ContainerInterface $container, EntityManager $entityManager)
    {
        $this->container = $container;
        $this->entityManager = $entityManager;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "purge_user_tables";
    }

    /**
     * @param SuiteEvent $suiteEvent
     * @param array $options
     */
    public function beforeSuite(SuiteEvent $suiteEvent, array $options)
    {
        //$contactRepo = $this->container->get('red_carpet.repository.contact');
        $customerRepo = $this->container->get('rc.repository.customer');
        $userRepo = $this->entityManager->getRepository('RCUserBundle:User');

        $repos = [$customerRepo, $userRepo];

        /** @var EntityRepository $repo */
        foreach ($repos as $repo){
            $items = $repo->findAll();
            foreach ($items as $item){
                $this->entityManager->remove($item);
            }
        }
        $this->entityManager->flush();
    }
}
